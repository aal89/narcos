<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooldownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooldowns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id')->unique();
            $table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade');
            $table->timestamp('travel');
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
        Schema::dropIfExists('cooldowns');
    }
}
