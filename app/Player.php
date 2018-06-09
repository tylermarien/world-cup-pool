<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id',
        'name',
    ];

    /**
     * Scope the query to return players that were entered by a given entry.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Entry|int                        $entry
     *
     * @return void
     */
    public function scopeEnteredBy(Builder $query, $entry)
    {
        if ($entry instanceof Entry) {
            $entry = $entry->getKey();
        }

        $query->whereHas('entry', function (Builder $query) use ($entry) {
            $query->where('id', $entry);
        });
    }

    /**
     * Return a player's related entry records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entries()
    {
        return $this->belongsTo(Entry::class);
    }
}
