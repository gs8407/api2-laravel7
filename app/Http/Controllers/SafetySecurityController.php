<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class SafetySecurityController extends Controller
{
    /**
     * safety and security api index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eula = DB::table('safety_security')->first();
        return view('safety_security', compact('safety_security'));
    }

    /**
     * safety and security api store
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $body = $request->body;

        DB::table('safety_security')->update(['body' => $body, 'updated_at' => \Carbon\Carbon::now()]);

        $safety_security = DB::table('safety_security')->first();
        return view('safety_security', compact('safety_security'));
    }
}
