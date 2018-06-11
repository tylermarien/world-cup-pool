<?php

namespace App\SportsDb;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'sportdb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'event_id',
        'title',
        'title2',
        'pos',
        'knockout',
        'start_at',
        'end_at',
        'auto',
    ];
}
