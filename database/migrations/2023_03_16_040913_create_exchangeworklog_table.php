<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeworklogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchangeworklog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('changer_id');
            $table->bigInteger('replacer_id');
            $table->date('date_change');
            $table->date('date_replace')->nullable();
            $table->tinyInteger('shift_change');
            $table->tinyInteger('shift_replace')->nullable();
            $table->tinyInteger('doitlater')->default(0);
            $table->tinyInteger('change_commit')->default(0);
            $table->tinyInteger('replace_commit')->default(0);
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
        Schema::dropIfExists('exchangeworklog');
    }
}
