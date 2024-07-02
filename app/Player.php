<?php

namespace App;

use App\Traits\Enterable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Player
 *
 * @property int $id
 * @property int $team_id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Entry $entries
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player enteredBy($entry)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Player extends Model
{
    use Enterable;

    const POINTS_GOAL = 2;
    const POINTS_SHOOTOUT_GOAL = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'team_id',
        'name',
        'goals',
        'shootout_goals',
    ];

    /**
     * Return a player's related entry records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function entries()
    {
        return $this->belongsToMany(Entry::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function calculateTotal()
    {
        return $this->calculateGoalPoints() + $this->calculateShootoutGoalPoints();
    }

    public function calculateGoalPoints()
    {
        return $this->goals * self::POINTS_GOAL;
    }

    public function calculateShootoutGoalPoints()
    {
        return $this->shootout_goals * self::POINTS_SHOOTOUT_GOAL;
    }
}
