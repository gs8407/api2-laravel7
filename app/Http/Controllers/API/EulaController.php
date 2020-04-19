<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class EulaController extends Controller
{
    /**
     * Eula api show
     *
     * @return \Illuminate\Http\Response
     **/

    public function show()
    {
        $eula = DB::table('eula')->first();
        return $eula->body;
    }

    /**
     * Eula api update
     *
     * @return \Illuminate\Http\Response
     **/

    public function update(Request $request)
    {
        $body = $request->body;

        //DB::update('update eula where id = 1 set body = $body' );

        DB::table('eula')
            ->where('id', 1)
            ->update(['body' => $body, 'updated_at' => \Carbon\Carbon::now()]);

        return response(['message' => 'Eula content is updated!']);

    }
}
