<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeyToTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('teams', 'key')) {
            Schema::table('teams', function (Blueprint $table) {
                $table->string('key', 64)->nullable()->index()->after('id');
            });

            DB::table('teams')->update([
                'key' => DB::raw('LOWER(SUBSTRING(name, LOCATE(\' \', name) + 1))')
            ]);
        }
    }
}
