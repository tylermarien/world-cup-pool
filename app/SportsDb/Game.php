<?php

namespace App\SportsDb;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    const WINNER_TIE = 0;
    const WINNER_HOME_TEAM = 1;
    const WINNER_AWAY_TEAM = 2;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'winner' => 'int',
    ];

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
        'key',
        'round_id',
        'pos',
        'group_id',
        'team1_id',
        'team2_id',
        'play_at',
        'postponed',
        'play_at_v2',
        'play_at_v3',
        'ground_id',
        'city_id',
        'knockout',
        'home',
        'score1',
        'score2',
        'score1et',
        'score2et',
        'score1p',
        'score2p',
        'score1i',
        'score2i',
        'score1ii',
        'score2ii',
        'next_game_id',
        'prev_game_id',
        'winner',
        'winner90',
    ];

    /**
     * Return the Game's round
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    /**
     * Is the game over?
     *
     * @return boolean
     */
    public function isOver()
    {
        return $this->isHomeTeamVictory()
            || $this->isAwayTeamVictory()
            || $this->isTie();
    }

    /**
     * Did the home team win?
     *
     * @return boolean
     */
    public function isHomeTeamVictory()
    {
        return $this->winner === self::WINNER_HOME_TEAM;
    }

    /**
     * Did the away team win?
     *
     * @return boolean
     */
    public function isAwayTeamVictory()
    {
        return $this->winner === self::WINNER_AWAY_TEAM;
    }

    /**
     * Did it end in a tie?
     */
    public function isTie()
    {
        return $this->winner === self::WINNER_TIE;
    }

    /**
     * Did the home team win in shootout?
     *
     * @return boolean
     */
    public function isHomeTeamShootoutVictory()
    {
        return $this->score1p > $this->score2p;
    }

    /**
     * Did the away team win in shootout?
     *
     * @return boolean
     */
    public function isAwayTeamShootoutVictory()
    {
        return $this->score2p > $this->score1p;
    }

    /**
     * Did the home team have a shutout
     *
     * @return boolean
     */
    public function isHomeTeamShutout()
    {
        return $this->isOver() && $this->score2 == 0 && $this->score2et == 0;
    }

    /**
     * Did the away team have a shutout
     *
     * @return boolean
     */
    public function isAwayTeamShutout()
    {
        return $this->isOver() && $this->score1 == 0 && $this->score1et == 0;
    }

    /**
     * Is this game the final
     *
     * @return boolean
     */
    public function isFinal()
    {
        return $this->round->title == 'Final';
    }

    /**
     * Is this game the third place game
     *
     * @return boolean
     */
    public function isThirdPlaceGame()
    {
        return $this->round->title == 'Match for third place';
    }
}
