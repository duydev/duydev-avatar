<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('frames');

        Schema::create('frames', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->text('picture');
            $table->text('default_picture');
            $table->string('slug');
            $table->integer('count')->default(0);
            $table->string('view')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

        DB::statement('ALTER TABLE `frames` ROW_FORMAT=DYNAMIC;');

        Schema::table('frames',function(Blueprint $table){
            $table->unique('slug');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frames');
    }
}
