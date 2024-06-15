<?php

namespace App\Console\Commands;

use App\Team;
use App\Player;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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
     * The teams
     *
     * @var \App\Team
     */
    private $teams;

    /**
     * The players
     *
     * @var \App\Player
     */
    private $players;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Team $teams, Player $players)
    {
        parent::__construct();

        $this->teams = $teams;
        $this->players = $players;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $teams = Http::get('https://api.github.com/repos/openfootball/euro/contents/2024--germany/squads');

        $this->teams->truncate();
        $this->players->truncate();

        $players = collect();
        foreach ($teams->json() as $team) {
            // get team name
            $name = ucfirst(pathinfo($team['name'], PATHINFO_FILENAME));

            // insert team
            $team2 = $this->teams->create(['key' => mb_strtolower($name, 'UTF-8'), 'name' => $name]);

            // get players
            $response = Http::get($team['download_url']);
            $lines = collect(array_filter(array_slice(explode("\n", $response->body()), 2), fn($line) => !empty(trim($line))));
            $lines = $lines->map(function ($line) use ($team2) {
                $name = trim(explode(',', $line)[1]);
                $names = explode(' ', $name);
                $key = mb_strtolower(array_pop($names), 'UTF-8');
                return ['team_id' => $team2->id, 'key' => $key, 'name' => $name];
            });
            $players = $players->merge($lines);
        }

        $players->duplicates('key')->each(function (string $key, int $index) use ($players) {
            $player = $players->get($index);
            $player['key'] = str_replace(' ', '_', mb_strtolower($player['name'], 'UTF-8'));
            $players->put($index, $player);
        });
        $this->players->insert($players->toArray());
    }
}
