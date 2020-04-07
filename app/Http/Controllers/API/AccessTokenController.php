<?php

namespace App\Http\Controllers\API;

use App\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;
use Response;
use \Laravel\Passport\Http\Controllers\AccessTokenController as ATC;

class AccessTokenController extends ATC
{
    public function issueToken(ServerRequestInterface $request)
    {
        try {
            //get username (default is :email)
            $email = $request->getParsedBody()['username'];

            //get user
            //change to 'email' if you want
            $user = User::where('email', '=', $email)->first();

            //generate token
            $tokenResponse = parent::issueToken($request);

            //convert response to json string
            $content = $tokenResponse->getContent();

            //convert json to array
            $data = json_decode($content, true);

            if (isset($data["error"]))
                throw new OAuthServerException('The user credentials were incorrect.', 'invalid_credentials', 401);

            //add access token to user
            $user = collect($user);
            $user->put('access_token', $data['access_token']);
            $user->put('expires_in', $data['expires_in']);
            $user->put('refresh_token', $data['refresh_token']);

            // return Response::json(array($user));

            return response(["access_token" => $data['access_token'], "expires_in" => $data['expires_in'], "refresh_token" => $data['refresh_token']]);

        } catch (ModelNotFoundException $e) {
            // email notfound
            //return error message
            return response(["message" => "The user credentials are incorrect.", 'invalid_credentials', 401]);
        } catch (OAuthServerException $e) {
            //password not correct token not granted
            //return error message
            return response(["message" => "The user credentials are incorrect.", 'invalid_credentials', 401]);
        } catch (Exception $e) {
            ////return error message
            return response(["message" => "The user credentials are incorrect.", 'invalid_credentials', 401]);
        }
    }
}
