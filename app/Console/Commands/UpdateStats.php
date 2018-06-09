<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Symfony\Component\Process\Process;
use Illuminate\Database\DatabaseManager;

class UpdateStats extends Command
{
    const POINTS_TEAM_GAMES_PLAYED = 1;
    const POINTS_TEAM_WIN = 4;
    const POINTS_TEAM_TIE = 2;
    const POINTS_TEAM_GOAL_DIFFERENTIAL = 1;
    const POINTS_TEAM_SHOOTOUT_WIN = 1;
    const POINTS_TEAM_SHUTOUT = 1;
    const POINTS_TEAM_FIRST_IN_POOL = 4;
    const POINTS_TEAM_SECOND_IN_POOL = 2;
    const POINTS_TEAM_THIRD_IN_POOL = 1;
    const POINTS_TEAM_FIRST = 8;
    const POINTS_TEAM_SECOND = 5;
    const POINTS_TEAM_THIRD = 3;

    const POINTS_PLAYER_GOAL = 2;
    const POINTS_PLAYER_SHOOTOUT_GOAL = 1;

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
        $this->db->table('entries')->get()->each(function ($entry) {
            $total = $this->calculateTeamPoints($entry) + $this->calculatePlayerPoints($entry);

            $this->db->table('entries')->where('entry_id', $entry->id)->update(['total' => $total]);
        });
    }

    /**
     * Calculate points based on team results
     *
     * @param stdObject $entry
     *
     * @return int
     */
    public function calculateTeamPoints($entry)
    {
        $teams = $this->db
            ->table('teams')
            ->join('entry_team', 'teams.id', '=', 'entry_team.team_id')
            ->where('entry_team.entry_id', $entry->id)
            ->get();

        $games = $this->sportdb
            ->table('games')
            ->where(function ($query) use ($teams) {
                $query->whereIn('team1_id', $teams->pluck('id'))
                    ->orWhereIn('team2_id', $teams->pluck('id'));
            })
            ->get();

        $gamesPlayed = $this->calculateGamesPlayed($games);
        $wins = $this->calculateWins($games, $teams);
        $ties = $this->calculateTies($games, $teams);
        $goalDifferential = $this->calculateGoalDifferential($games, $teams);
        $shutouts = $this->calculateShutouts($games, $teams);
        $shootoutWins = $this->calculateShootoutWins($games, $teams);
        $firstInPool = $this->calculateFirstInPool($teams);
        $secondInPool = $this->calculateSecondInPool($teams);
        $thirdInPool = $this->calculateThirdInPool($teams);
        $first = $this->calculateFirst($teams);
        $second = $this->calculateSecond($teams);
        $third = $this->calculateThird($teams);

        return ($gamesPlayed * self::POINTS_TEAM_GAMES_PLAYED) +
            ($wins * self::POINTS_TEAM_WIN) +
            ($ties * self::POINTS_TEAM_TIE) +
            ($goalDifferential * self::POINTS_TEAM_GOAL_DIFFERENTIAL) +
            ($shutouts * self::POINTS_TEAM_SHUTOUT) +
            ($shootoutWins * self::POINTS_TEAM_SHOOTOUT_WIN) +
            ($firstInPool * self::POINTS_TEAM_FIRST_IN_POOL) +
            ($secondInPool * self::POINTS_TEAM_SECOND_IN_POOL) +
            ($thirdInPool * self::POINTS_TEAM_THIRD_IN_POOL) +
            ($first * self::POINTS_TEAM_FIRST) +
            ($second * self::POINTS_TEAM_SECOND) +
            ($third * self::POINTS_TEAM_THIRD);
    }

    /**
     * Calculate points based on number of games played
     *
     * @param \Illuminate\Support\Collection $games
     *
     * @return int
     */
    public function calculateGamesPlayed(Collection $games)
    {
        return $games->filter(function ($game) {
            return $game->winner != '';
        })->count();
    }

    /**
     * Calculate points based number of team wins
     *
     * @param \Illuminate\Support\Collection $games
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateWins(Collection $games, Collection $teams)
    {
        return $games->whereIn('winner', $teams->pluck('id'))->count();
    }

    /**
     * Calculate points based number of team ties
     *
     * @param \Illuminate\Support\Collection $games
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateTies(Collection $games, Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate points based on goal differential (goals scored - goals surrendered)
     *
     * @param \Illuminate\Support\Collection $games
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateGoalDifferential(Collection $games, Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate points based number of team shutouts
     *
     * @param \Illuminate\Support\Collection $games
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateShutouts(Collection $games, Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate points based number of team wins in shootouts
     *
     * @param \Illuminate\Support\Collection $games
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateShootoutWins(Collection $games, Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate points based number of teams that placed first in their pool
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateFirstInPool(Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate points based number of teams that placed second in their pool
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateSecondInPool(Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate points based number of teams that placed third in their pool
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateThirdInPool(Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate points based on if one of these teams placed first in tournament
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateFirst(Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate points based on if one of these teams placed second in tournament
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateSecond(Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate points based if one of these teams placed third in tournament
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateThird(Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate points based on players
     *
     * @param stdObject $entry
     *
     * @return int
     */
    public function calculatePlayerPoints($entry)
    {
        $players = $this->db
            ->table('players')
            ->join('entry_player', 'players.id', '=', 'entry_player.player_id')
            ->where('entry_player.entry_id', $entry->id)
            ->get();

        $playerGoals = 0;

        return $playerGoals;
    }
}
