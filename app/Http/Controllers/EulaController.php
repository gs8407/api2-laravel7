<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class EulaController extends Controller
{
    /**
     * Eula api index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eula = DB::table('eula')->first();
        return view('eula', compact('eula'));
    }

    /**
     * Eula api store
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $body = $request->body;

        DB::table('eula')->update(['body' => $body, 'updated_at' => \Carbon\Carbon::now()]);

        $eula = DB::table('eula')->first();
        return view('eula', compact('eula'));
    }
}
