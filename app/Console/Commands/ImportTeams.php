<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class ImportTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:teams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the teams from the sportsdb database into our database';

    /**
     * The database connection for our database
     *
     * @var \Illuminate\Database\Connection
     */
    private $db;

    /**
     * The database connection for the sportdb database
     *
     * @var \Illuminate\Database\Connection
     */
    private $sportdb;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DatabaseManager $manager)
    {
        parent::__construct();

        $this->db = $manager->connection();
        $this->sportdb = $manager->connection('sportdb');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $teams = $this->sportdb
            ->table('teams')
            ->join('groups_teams', 'teams.id', '=', 'groups_teams.team_id')
            ->select('teams.id', 'teams.title')
            ->get()
            ->map(function ($team) use ($now) {
                return [
                    'id' => $team->id,
                    'name' => $team->title,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            })
            ->toArray();

        $this->db->table('teams')->truncate();
        $this->db->table('teams')->insert($teams);
    }
}
