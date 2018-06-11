<?php

namespace App\SportsDb;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
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
        'person_id',
        'game_id',
        'team_id',
        'minute',
        'offset',
        'score1',
        'score2',
        'penalty',
        'owngoal',
    ];

}
