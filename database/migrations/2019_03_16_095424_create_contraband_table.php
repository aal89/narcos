<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContrabandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contraband', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id')->unique();
            $table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade');
            $table->integer('weed')->default('0');
            $table->integer('lsd')->default('0');
            $table->integer('speed')->default('0');
            $table->integer('cocaine')->default('0');
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
        Schema::dropIfExists('contraband');
    }
}
