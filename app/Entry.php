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
        return
            ($this->calculateGamesPlayed() * self::POINTS_TEAM_GAMES_PLAYED)
            + ($this->calculateWins() * self::POINTS_TEAM_WIN)
            + ($this->calculateTies() * self::POINTS_TEAM_TIE)
            + ($this->calculateGoalDifferential() * self::POINTS_TEAM_GOAL_DIFFERENTIAL)
            + ($this->calculateShootoutWins() * self::POINTS_TEAM_SHOOTOUT_WIN)
            + ($this->calculateShutouts() * self::POINTS_TEAM_SHUTOUT)
            + ($this->calculateFirstInGroup() * self::POINTS_TEAM_FIRST_IN_GROUP)
            + ($this->calculateSecondInGroup() * self::POINTS_TEAM_SECOND_IN_GROUP)
            + ($this->calculateThirdInGroup() * self::POINTS_TEAM_THIRD_IN_GROUP)
            + ($this->calculateFirst() * self::POINTS_TEAM_FIRST)
            + ($this->calculateSecond() * self::POINTS_TEAM_SECOND)
            + ($this->calculateThird() * self::POINTS_TEAM_THIRD)
            + ($this->calculateGoals() * self::POINTS_PLAYER_GOAL)
        ;
    }

    /**
     * Calculate the number of games played for this entry
     *
     * @return int
     */
    public function calculateGamesPlayed()
    {
        return $this->teams->sum('games_played');
    }

    /**
     * Calculate the number of games played for this entry
     *
     * @return int
     */
    public function calculateWins()
    {
        return $this->teams->sum('wins');
    }

    /**
     * Calculate the number of games played for this entry
     *
     * @return int
     */
    public function calculateTies()
    {
        return $this->teams->sum('ties');
    }

    /**
     * Calculate the goals differential for this entry
     *
     * @return int
     */
    public function calculateGoalDifferential()
    {
        return $this->teams->sum('goal_differential');
    }

    /**
     * Calculate the number of shootout wins for this entry
     *
     * @return int
     */
    public function calculateShootoutWins()
    {
        return $this->teams->sum('shootout_wins');
    }

    /**
     * Calculate the number of shutouts for this entry
     *
     * @return int
     */
    public function calculateShutouts()
    {
        return $this->teams->sum('shutouts');
    }

    /**
     * Calculate the number of first in groups
     *
     * @return int
     */
    public function calculateFirstInGroup()
    {
        return 0;
    }

    /**
     * Calculate the number of second in groups
     *
     * @return int
     */
    public function calculateSecondInGroup()
    {
        return 0;
    }

    /**
     * Calculate the number of third in groups
     *
     * @return int
     */
    public function calculateThirdInGroup()
    {
        return 0;
    }

    /**
     * Calculate the number of firsts
     *
     * @return int
     */
    public function calculateFirst()
    {
        return 0;
    }

    /**
     * Calculate the number of second in groups
     *
     * @return int
     */
    public function calculateSecond()
    {
        return 0;
    }

    /**
     * Calculate the number of third
     *
     * @return int
     */
    public function calculateThird()
    {
        return 0;
    }

    /**
     * Calculate the number of goals
     *
     * @return int
     */
    public function calculateGoals()
    {
        return $this->players->sum('goals');
    }
}
