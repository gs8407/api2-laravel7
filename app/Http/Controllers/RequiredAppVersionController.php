<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class RequiredAppVersionController extends Controller
{
    /**
     * safety and security api index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $required_version = DB::table('required_version')->first();
        return view('required_version', compact('required_version'));
    }

    /**
     * safety and security api store
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recommendedVersion = $request->recommendedVersion;
        $requiredVersion = $request->requiredVersion;

        DB::table('required_version')->update(['recommendedVersion' => $recommendedVersion, 'requiredVersion' => $requiredVersion, 'updated_at' => \Carbon\Carbon::now()]);

        $required_version = DB::table('required_version')->first();
        return view('required_version', compact('required_version'));
    }
}
