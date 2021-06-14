<?php

namespace App;

use App\Traits\Enterable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Team
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team enteredBy($entry)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Team extends Model
{
    use Enterable;

    const POINTS_GAMES_PLAYED = 1;
    const POINTS_WIN = 4;
    const POINTS_TIE = 2;
    const POINTS_GOAL_DIFFERENTIAL = 1;
    const POINTS_SHOOTOUT_WIN = 1;
    const POINTS_SHUTOUT = 1;
    const POINTS_FIRST_IN_GROUP = 4;
    const POINTS_SECOND_IN_GROUP = 2;
    const POINTS_THIRD_IN_GROUP = 1;
    const POINTS_FIRST = 8;
    const POINTS_SECOND = 5;
    const POINTS_THIRD = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'name',
    ];

    /**
     * Return a team's related entry records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function entries()
    {
        return $this->belongsToMany(Entry::class);
    }

    /**
     * Return an teams's related player records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function calculateTotal()
    {
        return $this->calculateGamesPlayedPoints()
        + $this->calculateWinPoints()
        + $this->calculateTiePoints()
        + $this->calculateGoalDifferentialPoints()
        + $this->calculateShootoutWinPoints()
        + $this->calculateShutoutPoints()
        + $this->calculatePoolPlacingPoints()
        + $this->calculateFinalPlacingPoints();
    }

    public function calculateGamesPlayedPoints()
    {
        return $this->games_played * self::POINTS_GAMES_PLAYED;
    }

    public function calculateWinPoints()
    {
        return $this->wins * self::POINTS_WIN;
    }

    public function calculateTiePoints()
    {
        return $this->ties * self::POINTS_TIE;
    }

    public function calculateGoalDifferentialPoints()
    {
        return $this->goal_differential * self::POINTS_GOAL_DIFFERENTIAL;
    }

    public function calculateShootoutWinPoints()
    {
        return $this->shootout_wins * self::POINTS_SHOOTOUT_WIN;
    }

    public function calculateShutoutPoints()
    {
        return $this->shutouts * self::POINTS_SHUTOUT;
    }

    public function calculatePoolPlacingPoints()
    {
        switch($this->pool_placing) {
            case 1:
                return self::POINTS_FIRST_IN_GROUP;
            case 2:
                return self::POINTS_SECOND_IN_GROUP;
            case 3:
                return self::POINTS_THIRD_IN_GROUP;
            default:
                return 0;
        }
    }

    public function calculateFinalPlacingPoints()
    {
        switch($this->final_placing) {
            case 1:
                return self::POINTS_FIRST;
            case 2:
                return self::POINTS_SECOND;
            case 3:
                return self::POINTS_THIRD;
            default:
                return 0;
        }
    }

    /**
     * Calculate the number of first in groups
     *
     * @return int
     */
    public function calculateFirstInGroup()
    {
        return $this->pool_placing == 1 ? 1 : 0;
    }

    /**
     * Calculate the number of second in groups
     *
     * @return int
     */
    public function calculateSecondInGroup()
    {
        return $this->pool_placing == 2 ? 1 : 0;
    }

    /**
     * Calculate the number of third in groups
     *
     * @return int
     */
    public function calculateThirdInGroup()
    {
        return $this->pool_placing == 3 ? 1 : 0;
    }

    /**
     * Calculate the number of firsts
     *
     * @return int
     */
    public function calculateFirst()
    {
        return $this->final_placing == 1 ? 1 : 0;
    }

    /**
     * Calculate the number of second in groups
     *
     * @return int
     */
    public function calculateSecond()
    {
        return $this->final_placing == 2 ? 1 : 0;
    }

    /**
     * Calculate the number of third
     *
     * @return int
     */
    public function calculateThird()
    {
        return $this->final_placing == 3 ? 1 : 0;
    }
}
