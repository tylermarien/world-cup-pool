<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $pool_id = DB::table('pools')->insert([
            'name' => 'Test Pool',
        ]);

        $entry_id = DB::table('entries')->insert([
            'pool_id' => $pool_id,
            'name' => 'Tyler Marien',
            'total' => 0,
        ]);

        DB::table('teams')->get()->random(13)->each(function ($team) use ($entry_id) {
            DB::table('entry_team')->insert([
                'entry_id' => $entry_id,
                'team_id' => $team->id,
            ]);
        });
    }
}
