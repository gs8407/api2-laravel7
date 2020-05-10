<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Toy;
use Auth;
use Validator;


class ToyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $messages = [
            'toy_id.unique' => 'The toy_id has already been taken.',
            'toy_serial.unique' => 'The toy_serial has already been taken.',
        ];

        $validator = Validator::make($request->all(), [
            'toy_id' => 'unique:toys',
            'toy_serial' => 'unique:toys',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user_id = Auth::user()->id;

        $toy = new Toy;
        $toy->user_id = $user_id;
        $toy->toy_id = $request->toy_id;
        $toy->toy_serial = $request->toy_serial;
        $toy->created_at = \Carbon\Carbon::now();
        $toy->updated_at = \Carbon\Carbon::now();

        $toy->save();

        return response()->json([
            'message' => 'Successfully initalized the Toy',
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Toy  $toy
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return "test";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Toy  $toy
     * @return \Illuminate\Http\Response
     */
    public function edit(Toy $toy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Toy  $toy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Toy $toy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Toy  $toy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toy $toy)
    {
        //
    }
}
