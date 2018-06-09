<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
}
