<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Entry;
use App\Team;
use App\Player;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use App\SportsDb\Team as SportsDbTeam;
use Symfony\Component\Process\Process;
use Illuminate\Database\DatabaseManager;
use App\SportsDb\Person as SportsDbPerson;

class UpdateStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates stats from sportsdb database and updates our database';

    /**
     * The Entry model
     *
     * @var \App\Entry
     */
    protected $entries;

    /**
     * The Team model
     *
     * @var \App\Team
     */
    protected $teams;

    /**
     * The Player model
     *
     * @var \App\Player
     */
    protected $players;

    /**
     * Create a new command instance.
     *
     * @param Entry $entries
     * @param Team $teams
     * @param Player $players
     *
     * @return void
     */
    public function __construct(Entry $entries, Team $teams, Player $players)
    {
        parent::__construct();

        $this->entries = $entries;
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
        $this->call('sportsdb:delete');
        $this->call('sportsdb:create');

        $teams = SportsDbTeam::all();
        $teams->each(function ($team) {
            $this->teams->where('id', $team->id)->update([
                'games_played' => $team->calculateGamesPlayed(),
                'wins' => $team->calculateWins(),
                'ties' => $team->calculateTies(),
                'goal_differential' => $team->calculateGoalDifferential(),
                'shootout_wins' => $team->calculateShootoutWins(),
                'shutouts' => $team->calculateShutouts(),
            ]);
        });

        $this->players->all()->each(function ($player) {
            $keys = explode(',', $player->key);
            $persons = SportsDbPerson::whereIn('key', $keys)->get();
            $player->goals = $persons->sum(function ($person) {
                $person->goals()->count();
            });
            $player->save();
        });

        $this->entries->all()->each(function ($entry) {
            $entry->total = $entry->calculateTotal();
            $entry->save();
        });
    }
}
