<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmdlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmdlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('level1');
            $table->date('date');
            $table->time('time');
            $table->string('site');
            $table->string('server');
            $table->string('func');
            $table->integer('level2');
            $table->string('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cmdlogs');
    }
}
