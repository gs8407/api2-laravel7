<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use DB;

class EulaController extends Controller
{
    /**
     * safety and security api show
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $eula = DB::table('eula')->first();
        return $eula->content;
    }
}
