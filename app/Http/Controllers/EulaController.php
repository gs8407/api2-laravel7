<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;

class EulaController extends Controller
{
    /**
     * safety and security api index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eula = DB::table('eula')->first();
        return view('eula', compact('eula'));
    }

    /**
     * safety and security api store
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $request->content;

        DB::table('eula')->update(['content' => $content]);

        $eula = DB::table('eula')->first();
        return view('eula', compact('eula'));
    }
}
