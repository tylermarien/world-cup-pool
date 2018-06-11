<?php

namespace App;

use Illuminate\Support\Collection;
use App\SportsDb\Team as SportsDbTeam;
use Illuminate\Database\Eloquent\Model;
use App\SportsDb\Person as SportsDbPerson;

/**
 * App\Entry
 *
 * @property int $id
 * @property int $pool_id
 * @property string $name
 * @property int $total
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Player[] $players
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $teams
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entry wherePoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entry whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Entry extends Model
{
    const POINTS_TEAM_GAMES_PLAYED = 1;
    const POINTS_TEAM_WIN = 4;
    const POINTS_TEAM_TIE = 2;
    const POINTS_TEAM_GOAL_DIFFERENTIAL = 1;
    const POINTS_TEAM_SHOOTOUT_WIN = 1;
    const POINTS_TEAM_SHUTOUT = 1;
    const POINTS_TEAM_FIRST_IN_GROUP = 4;
    const POINTS_TEAM_SECOND_IN_GROUP = 2;
    const POINTS_TEAM_THIRD_IN_GROUP = 1;
    const POINTS_TEAM_FIRST = 8;
    const POINTS_TEAM_SECOND = 5;
    const POINTS_TEAM_THIRD = 3;

    const POINTS_PLAYER_GOAL = 2;
    const POINTS_PLAYER_SHOOTOUT_GOAL = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pool_id',
        'name',
        'total',
    ];

    /**
     * Return an entry's related player records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->belongsToMany(Player::class);
    }

    /**
     * Return an entry's related team records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    /**
     * Calcualte the total
     *
     * @return int
     */
    public function calculateTotal()
    {
        $teams = SportsDbTeam::whereIn('id', $this->teams->pluck('id'))->get();
        $persons = SportsDbPerson::whereIn('id', $this->players->pluck('id'))->get();

        return
            ($this->calculateGamesPlayed($teams) * self::POINTS_TEAM_GAMES_PLAYED)
            + ($this->calculateWins($teams) * self::POINTS_TEAM_WIN)
            + ($this->calculateTies($teams) * self::POINTS_TEAM_TIE)
            + ($this->calculateGoalDifferential($teams) * self::POINTS_TEAM_GOAL_DIFFERENTIAL)
            + ($this->calculateShootoutWins($teams) * self::POINTS_TEAM_SHOOTOUT_WIN)
            + ($this->calculateShutouts($teams) * self::POINTS_TEAM_SHUTOUT)
            + ($this->calculateFirstInGroup($teams) * self::POINTS_TEAM_FIRST_IN_GROUP)
            + ($this->calculateSecondInGroup($teams) * self::POINTS_TEAM_SECOND_IN_GROUP)
            + ($this->calculateThirdInGroup($teams) * self::POINTS_TEAM_THIRD_IN_GROUP)
            + ($this->calculateFirst($teams) * self::POINTS_TEAM_FIRST)
            + ($this->calculateSecond($teams) * self::POINTS_TEAM_SECOND)
            + ($this->calculateThird($teams) * self::POINTS_TEAM_THIRD)
            + ($this->calculateGoals($persons) * self::POINTS_PLAYER_GOAL)
            + ($this->calculateShootoutGoals($persons) * self::POINTS_PLAYER_SHOOTOUT_GOAL)
        ;
    }

    /**
     * Calculate the number of games played for this entry
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateGamesPlayed(Collection $teams)
    {
        return $teams->sum(function ($team) {
            return $team->calculateGamesPlayed();
        });
    }

    /**
     * Calculate the number of games played for this entry
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateWins(Collection $teams)
    {
        return $teams->sum(function ($team) {
            return $team->calculateWins();
        });
    }

    /**
     * Calculate the number of games played for this entry
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateTies(Collection $teams)
    {
        return $teams->sum(function ($team) {
            return $team->calculateTies();
        });
    }

    /**
     * Calculate the goals differential for this entry
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateGoalDifferential(Collection $teams)
    {
        return $teams->sum(function ($team) {
            return $team->calculateGoalDifferential();
        });
    }

    /**
     * Calculate the number of shootout wins for this entry
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateShootoutWins(Collection $teams)
    {
        return $teams->sum(function ($team) {
            return $team->calculateShootoutWins();
        });
    }

    /**
     * Calculate the number of shutouts for this entry
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateShutouts(Collection $teams)
    {
        return $teams->sum(function ($team) {
            return $team->calculateShutouts();
        });
    }

    /**
     * Calculate the number of first in groups
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateFirstInGroup(Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate the number of second in groups
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateSecondInGroup(Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate the number of third in groups
     *
     * @param \Illuminate\Support\Collection $teams
     *
     * @return int
     */
    public function calculateThirdInGroup(Collection $teams)
    {
        return 0;
    }

    /**
     * Calculate the number of firsts
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
     * Calculate the number of second in groups
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
     * Calculate the number of third
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
     * Calculate the number of goals
     *
     * @param \Illuminate\Support\Collection $persons
     *
     * @return int
     */
    public function calculateGoals(Collection $persons)
    {
        return $persons->sum(function ($person) {
            return $person->goals->count();
        });
    }

    /**
     * Calculate the number of shootout goals
     *
     * @param \Illuminate\Support\Collection $persons
     *
     * @return int
     */
    public function calculateShootoutGoals(Collection $persons)
    {
        return 0;
    }
}
