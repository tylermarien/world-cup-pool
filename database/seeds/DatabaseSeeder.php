<?php

use Carbon\Carbon;
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
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $pool_id = DB::table('pools')->insert([
            'name' => 'Test Pool',
            'created_at' => $now,
            'updated_at' => $now,
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
