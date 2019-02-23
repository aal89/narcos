<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeaponBulletsColumnCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->enum('weapon', ['none', 'glock', 'shotgun', 'ak 47', 'm-16'])->default('none');
            $table->integer('bullets')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function($table) {
            $table->dropColumn('weapon');
            $table->dropColumn('bullets');
        });
    }
}
