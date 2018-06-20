<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatsFieldsToTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->integer('games_played')->default(0)->after('name');
            $table->integer('wins')->default(0)->after('games_played');
            $table->integer('ties')->default(0)->after('wins');
            $table->integer('goal_differential')->default(0)->after('ties');
            $table->integer('shootout_wins')->default(0)->after('goal_differential');
            $table->integer('shutouts')->default(0)->after('shootout_wins');
            $table->integer('pool_placing')->nullable()->after('shutouts');
            $table->integer('final_placing')->nullable()->after('pool_placing');
        });
    }
}
