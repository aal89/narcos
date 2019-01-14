<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('life');
            $table->integer('experience');
            $table->integer('money');
            $table->integer('contraband');
            $table->enum('country', ['colombia', 'mexico', 'puerto rico', 'united states of america']);
            $table->enum('vehicle', ['motor', 'boat', 'plane']);
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
        Schema::dropIfExists('characters');
    }
}
