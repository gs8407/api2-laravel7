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

        return (['requiredVersion' => $version->requiredVersion, 'recommendedVersion' => $version->recommendedVersion]);
    }
}
