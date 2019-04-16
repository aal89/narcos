<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id');
            $table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade')->nullable(false);
            $table->enum('country', ['colombia', 'mexico', 'puerto rico', 'united states of america'])->nullable(false);
            $table->integer('tile')->nullable(false);
            $table->enum('setup', ['weed', 'lsd', 'speed', 'cocaine'])->nullable()->default(null);
            $table->float('yield')->nullable(false)->default(0);
            $table->unique(['country', 'tile']);
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
        Schema::dropIfExists('properties');
    }
}
