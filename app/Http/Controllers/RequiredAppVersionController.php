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
        $recommendedVersionIOS = $request->recommendedVersionIOS;
        $requiredVersionIOS = $request->requiredVersionIOS;
        $recommendedVersionAndroid = $request->recommendedVersionAndroid;
        $requiredVersionAndroid = $request->requiredVersionAndroid;

        DB::table('required_version')->update(['recommendedVersionIOS' => $recommendedVersionIOS, 'requiredVersionIOS' => $requiredVersionIOS,'recommendedVersionAndroid' => $recommendedVersionAndroid, 'requiredVersionAndroid' => $requiredVersionAndroid, 'updated_at' => \Carbon\Carbon::now()]);

        $required_version = DB::table('required_version')->first();
        return view('required_version', compact('required_version'));
    }
}
