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
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'total' => 0,
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

    public function calculateGamesPlayed() {
        return $this->teams->sum('games_played');
    }

    public function calculateTeamsRemaining(): int
    {
        return $this->teams->sum(fn($team) => $team->eliminated ? 0 : 1);
    }

    /**
     * Calcualte the total
     *
     * @return int
     */
    public function calculateTotal()
    {
        return $this->teams->sum(function ($team) {
            return $team->calculateTotal();
        }) + $this->players->sum(function ($player) {
            return $player->calculateTotal();
        });
    }

    /**
     * Does this entry have specified team
     *
     * @param Team
     */
    public function hasTeam(Team $team): bool
    {
        return $this->teams->contains(fn(Team $comparison) => $comparison->id === $team->id);
    }

    /**
     * Does this entry have the specified player
     *
     * @param Player
     */
    public function hasPlayer(Player $player): bool
    {
        return $this->players->contains(fn(Player $comparison) => $comparison->id === $player->id);
    }
}
