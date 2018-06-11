<?php

namespace App\SportsDb;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
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
        'title',
    ];

    /**
     * Return a team's related home games
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function homeGames()
    {
        return $this->hasMany(Game::class, 'team1_id');
    }

    /**
     * Return a team's related away games
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function awayGames()
    {
        return $this->hasMany(Game::class, 'team2_id');
    }

    /**
     * Get number of games played
     *
     * @return int
     */
    public function calculateGamesPlayed()
    {
        return $this->calculateHomeGamesPlayed() + $this->calculateAwayGamesPlayed();
    }

    /**
     * Get number of home games played
     *
     * @return int
     */
    private function calculateHomeGamesPlayed()
    {
        return $this->homeGames->filter(function ($game) {
            return $game->isOver();
        })->count();
    }

    /**
     * Get number of home games played
     *
     * @return int
     */
    private function calculateAwayGamesPlayed()
    {
        return $this->awayGames->filter(function ($game) {
            return $game->isOver();
        })->count();
    }

    /**
     * Get number of wins
     *
     * @return int
     */
    public function calculateWins()
    {
        return $this->calculateHomeWins() + $this->calculateAwayWins();
    }

    /**
     * Get number of home wins
     *
     * @return int
     */
    public function calculateHomeWins()
    {
        return $this->homeGames->filter(function ($game) {
            return $game->isHomeTeamVictory();
        })->count();
    }

    /**
     * Get number of away wins
     *
     * @return int
     */
    public function calculateAwayWins()
    {
        return $this->awayGames->filter(function ($game) {
            return $game->isAwayTeamVictory();
        })->count();
    }

    /**
     * Get number of home ties
     *
     * @return boolean
     */
    public function calculateTies()
    {
        return $this->calculateHomeTies() + $this->calculateAwayTies();
    }

    /**
     * Get number of home ties
     *
     * @return boolean
     */
    private function calculateHomeTies()
    {
        return $this->homeGames->filter(function ($game) {
            return $game->isTie();
        })->count();
    }

    /**
     * Get number of home ties
     *
     * @return boolean
     */
    private function calculateAwayTies()
    {
        return $this->awayGames->filter(function ($game) {
            return $game->isTie();
        })->count();
    }

    /**
     * Get the goal differential
     *
     * @return int
     */
    public function calculateGoalDifferential()
    {
        return $this->homeGames->sum(function ($game) {
            return ($game->score1 + $game->score1et) - ($game->score2 + $game->score2et);
        }) + $this->awayGames->sum(function ($game) {
            return ($game->score2 + $game->score2et) - ($game->score1 + $game->score1et);
        });
    }

    /**
     * Get the number of shootout wins
     *
     * @return int
     */
    public function calculateShootoutWins()
    {
        return $this->homeGames->filter(function ($game) {
            return $game->isHomeTeamShootoutVictory();
        })->count() + $this->awayGames->filter(function ($game) {
            return $game->isAwayTeamShootoutVictory();
        })->count();
    }

    /**
     * Get the number of shutouts
     *
     * @return int
     */
    public function calculateShutouts()
    {
        return $this->homeGames->filter(function ($game) {
            return $game->isHomeTeamShutout();
        })->count() + $this->awayGames->filter(function ($game) {
            return $game->isAwayTeamShutout();
        })->count();
    }
}
