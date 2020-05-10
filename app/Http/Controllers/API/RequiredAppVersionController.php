<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class RequiredAppVersionController extends Controller
{
    /**
     * safety and security api index
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $version = DB::table('required_version')->first();

        return (['ios' => ['requiredVersion' => $version->requiredVersionIOS, 'recommendedVersion' => $version->recommendedVersionIOS], 'android' => ['requiredVersion' => $version->requiredVersionAndroid, 'recommendedVersion' => $version->recommendedVersionAndroid]]);
    }
}
