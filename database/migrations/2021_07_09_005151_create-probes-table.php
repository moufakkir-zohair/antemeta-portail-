<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProbesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('probes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('core_id');
            $table->foreign('core_id')->references('id')->on('cores');
            $table->string('objid');
            $table->string('name');
            $table->string('status');
            $table->boolean('changed');
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
        Schema::dropIfExists('probes');
    }
}
