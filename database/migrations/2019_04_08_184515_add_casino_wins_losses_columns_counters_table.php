<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCasinoWinsLossesColumnsCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counters', function ($table) {
            $table->integer('numbers_game_win')->default(0);
            $table->integer('numbers_game_loss')->default(0);
            $table->integer('roulette_win')->default(0);
            $table->integer('roulette_loss')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counters', function($table) {
            $table->dropColumn('numbers_game_win');
            $table->dropColumn('numbers_game_loss');
            $table->dropColumn('roulette_win');
            $table->dropColumn('roulette_loss');
        });
    }
}
