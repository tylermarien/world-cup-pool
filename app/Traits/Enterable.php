<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait Enterable
{
    /**
     * Scope the query to return players that were entered by a given entry.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int                                   $entry
     *
     * @return void
     */
    public function scopeEnteredBy(Builder $query, $entry)
    {
        if ($entry instanceof Model) {
            $entry = $entry->getKey();
        }

        $query->whereHas('entries', function (Builder $query) use ($entry) {
            $query->where('id', $entry);
        });
    }
}
