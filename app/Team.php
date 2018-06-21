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
        return ($this->games_played * self::POINTS_GAMES_PLAYED)
        + ($this->wins * self::POINTS_WIN)
        + ($this->ties * self::POINTS_TIE)
        + ($this->goal_differential * self::POINTS_GOAL_DIFFERENTIAL)
        + ($this->shootout_wins * self::POINTS_SHOOTOUT_WIN)
        + ($this->shutout_wins * self::POINTS_SHUTOUT)
        + ($this->calculateFirstInGroup() * self::POINTS_FIRST_IN_GROUP)
        + ($this->calculateSecondInGroup() * self::POINTS_SECOND_IN_GROUP)
        + ($this->calculateThirdInGroup() * self::POINTS_THIRD_IN_GROUP)
        + ($this->calculateFirst() * self::POINTS_FIRST)
        + ($this->calculateSecond() * self::POINTS_SECOND)
        + ($this->calculateThird() * self::POINTS_THIRD);
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
}
