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
            $table->unsignedInteger('user_id')->nullable()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('name')->unique();
            $table->integer('life')->default('100');
            $table->integer('experience')->default('0');
            $table->bigInteger('money')->default('0');
            $table->integer('contraband')->default('0');
            $table->enum('country', ['colombia', 'mexico', 'puerto rico', 'united states of america'])->default('colombia');
            $table->enum('transport', ['none', 'motor', 'boat', 'plane'])->default('none');
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
