<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizedCrimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organized_crimes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('robber_id')->nullable()->unique();
            $table->foreign('robber_id')->references('id')->on('characters')->onDelete('set null');
            $table->unsignedInteger('spotter_id')->nullable()->unique();
            $table->foreign('spotter_id')->references('id')->on('characters')->onDelete('set null');
            $table->unsignedInteger('driver_id')->nullable()->unique();
            $table->foreign('driver_id')->references('id')->on('characters')->onDelete('set null');
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
        Schema::dropIfExists('organized_crimes');
    }
}
