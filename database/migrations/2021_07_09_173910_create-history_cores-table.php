<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryCoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_cores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('core_id');
            $table->foreign('core_id')->references('id')->on('cores');
            $table->string('prtg-version');
            $table->unsignedBigInteger('totalsens');
            $table->unsignedBigInteger('upsens');
            $table->unsignedBigInteger('downsens');
            $table->unsignedBigInteger('warnsens');
            $table->unsignedBigInteger('downacksens');
            $table->unsignedBigInteger('partialdownsens');
            $table->unsignedBigInteger('unusualsens');
            $table->unsignedBigInteger('pausedsens');
            $table->unsignedBigInteger('undefinedsens');
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
        Schema::dropIfExists('history_cores');
    }
}
