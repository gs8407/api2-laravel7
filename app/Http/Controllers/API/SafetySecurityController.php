<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SafetySecurityController extends Controller
{
    /**
     * safety and security api show
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $safety_security = DB::table('safety_security')->first();
        return $safety_security->body;
    }
}
