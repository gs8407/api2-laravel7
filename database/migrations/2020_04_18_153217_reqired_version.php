<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReqiredVersion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('required_version', function (Blueprint $table) {
            $table->increments('id');
            $table->text('requiredVersionIOS')->nullable();
            $table->text('recommendedVersionIOS')->nullable();
            $table->text('requiredVersionAndroid')->nullable();
            $table->text('recommendedVersionAndroid')->nullable();
            $table->timestamps();
        });

        DB::table('required_version')->insert(
            array(
                'requiredVersionIOS' => '',
                'recommendedVersionIOS' => '',
                'requiredVersionAndroid' => '',
                'recommendedVersionAndroid' => '',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('required_version');
    }
}
