<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKillColumnsCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counters', function ($table) {
            $table->integer('kill_fail')->default(0);
            $table->integer('kill_success')->default(0);
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
            $table->dropColumn('kill_fail');
            $table->dropColumn('kill_success');
        });
    }
}
