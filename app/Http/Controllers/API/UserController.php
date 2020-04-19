<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as OClient;

class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $oClient = OClient::where('password_client', 1)->first();
            return $this->getTokenAndRefreshToken($oClient, request('email'), request('password'));
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $password = $request->password;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 'user';
        $user = User::create($input);
        $oClient = OClient::where('password_client', 1)->first();
        return $this->getTokenAndRefreshToken($oClient, $user->email, $password);
    }

    public function getTokenAndRefreshToken(OClient $oClient, $email, $password)
    {
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;
        $response = $http->request('POST', env('APP_URL','default_value') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);

        $result = json_decode((string)$response->getBody(), true);
        return response()->json($result, $this->successStatus);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json($user, $this->successStatus);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function unauthorized()
    {
        return response()->json("unauthorized", 401);
    }

    public function refreshToken(Request $request)
    {
        $refresh_token = $request->refresh_token;
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;

        try {
            $response = $http->request('POST', env('APP_URL','default_value') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refresh_token,
                    'client_id' => $oClient->id,
                    'client_secret' => $oClient->secret,
                    'scope' => '',
                ],
            ]);
            return json_decode((string)$response->getBody(), true);
        } catch (Exception $e) {
            //return response()->json(['error' => 'Bad refresh token'], 401);
            return $e->getResponse();
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function registerSubUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $password = $request->password;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 'subuser';
        $input['parent'] = Auth::user()->id;
        $user = User::create($input);
        $oClient = OClient::where('password_client', 1)->first();
        // return $this->getTokenAndRefreshToken($oClient, $user->email, $password);
        return response()->json([
            'message' => 'Successfully created Subuser'
        ]);
    }

    /**
     * Get Subuser api
     *
     * @return \Illuminate\Http\Response
     */
    public function showSubUsers(Request $request)
    {
        $parent = Auth::user()->id;
        //$subUsers = \App\User::where('parent', $parent);

        $subUsers = User::where(['parent' => Auth::user()->id])->get();

        return $subUsers;
    }

    /**
     * Delete Subuser api
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSubUser(Request $request)
    {
        $parent = Auth::user()->id;

        $subUsers = User::where(['parent' => Auth::user()->id, 'id' => $request->subuser])->delete();

        $message = "Successfully deleted Subuser " . $request->subuser;

        return response()->json([
            'message' => $message
        ]);
    }


}
