<?php

namespace App\SportsDb;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    const WINNER_TIE = 0;
    const WINNER_HOME_TEAM = 1;
    const WINNER_AWAY_TEAM = 2;

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
        'team1_id',
        'team2_id',
        'score1',
        'score2',
        'score1et',
        'score2et',
        'score1p',
        'score2p',
        'winner',
    ];

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
}
