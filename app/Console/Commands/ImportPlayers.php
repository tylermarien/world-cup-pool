<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\DatabaseManager;

class ImportPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the players from the Openfootball into our database';

    /**
     * The database connection for our database
     *
     * @var \Illuminate\Database\Connection
     */
    private $db;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DatabaseManager $manager)
    {
        parent::__construct();

        $this->db = $manager->connection();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $teams = Http::get('https://api.github.com/repos/openfootball/euro/contents/2024--germany/squads');

        $this->db->table('teams')->truncate();
        $this->db->table('players')->truncate();

        foreach ($teams->json() as $team) {
            // get team name
            $name = ucfirst(pathinfo($team['name'], PATHINFO_FILENAME));

            // insert team
            $id = $this->db->table('teams')->insert(['name' => $name]);

            // get players
            $response = Http::get($team['download_url']);
            $lines = array_filter(array_slice(explode("\n", $response->body()), 2), fn($line) => !empty(trim($line)));
            $players = array_map(fn ($line) => ['team_id' => $id, 'name' => trim(explode(',', $line)[1])], $lines);

            // insert players
            $this->db->table('players')->insert($players);
        }
    }
}
