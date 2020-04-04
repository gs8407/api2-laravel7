<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

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

    public function update(Request $request)
    {
        $content = $request->content;

        //DB::update('update eula where id = 1 set content = $content' );

        DB::table('eula')
            ->where('id', 1)
            ->update(['content' => $content]);

            return response(['message' => 'Eula content is updated!']);

    }
}
