<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Configs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('configs');

        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->longText('value');
        });

        DB::statement('ALTER TABLE `configs` ROW_FORMAT=DYNAMIC;');

        Schema::table('configs',function (Blueprint $table){
            $table->unique('key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
