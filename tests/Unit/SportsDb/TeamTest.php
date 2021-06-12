<?php

namespace Tests\Unit\SportsDb;

use Tests\TestCase;

class TeamTest extends TestCase
{
    public function testCalculateGamesPlayedWhenNoGames()
    {
        $team = factory(\App\SportsDb\Team::class)->make();

        $this->assertEquals(0, $team->calculateGamesPlayed());
    }

    public function testCalculateGamesPlayedWhenGames()
    {
        $team = factory(\App\SportsDb\Team::class)->make();
        $homeGames = factory(\App\SportsDb\Game::class, 3)->make([
            'winner' => 1,
        ]);
        $awayGames = factory(\App\SportsDb\Game::class, 3)->make([
            'winner' => 2,
        ]);

        $team->setRelation('homeGames', $homeGames);
        $team->setRelation('awayGames', $awayGames);

        $this->assertEquals(6, $team->calculateGamesPlayed());
    }

    public function testCalculateWins()
    {
        $team = factory(\App\SportsDb\Team::class)->make();

        $homeGames = collect();
        $homeGames->push(factory(\App\SportsDb\Game::class)->make(['winner' => 1]));
        $homeGames->push(factory(\App\SportsDb\Game::class)->make(['winner' => 2]));
        $awayGames = collect();
        $awayGames->push(factory(\App\SportsDb\Game::class)->make(['winner' => 1]));
        $awayGames->push(factory(\App\SportsDb\Game::class)->make(['winner' => 2]));

        $team->setRelation('homeGames', $homeGames);
        $team->setRelation('awayGames', $awayGames);

        $this->assertEquals(2, $team->calculateWins());
    }

    public function testCalculateTies()
    {
        $team = factory(\App\SportsDb\Team::class)->make();

        $homeGames = collect();
        $homeGames->push(factory(\App\SportsDb\Game::class)->make(['winner' => 1]));
        $homeGames->push(factory(\App\SportsDb\Game::class)->make(['winner' => 0]));
        $awayGames = collect();
        $awayGames->push(factory(\App\SportsDb\Game::class)->make(['winner' => 0]));
        $awayGames->push(factory(\App\SportsDb\Game::class)->make(['winner' => 2]));

        $team->setRelation('homeGames', $homeGames);
        $team->setRelation('awayGames', $awayGames);

        $this->assertEquals(2, $team->calculateTies());
    }

    public function testCalculateGoalDifferential()
    {
        $team = factory(\App\SportsDb\Team::class)->make();

        $homeGames = collect();
        $homeGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 2,
            'score2' => 0,
            'winner' => 1,
        ]));
        $homeGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 1,
            'score2' => 1,
            'winner' => 0,
        ]));
        $awayGames = collect();
        $awayGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 0,
            'score2' => 0,
            'winner' => 0,
        ]));
        $awayGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 1,
            'score2' => 1,
            'score1et' => 0,
            'score2et' => 1,
            'winner' => 2,
        ]));

        $team->setRelation('homeGames', $homeGames);
        $team->setRelation('awayGames', $awayGames);

        $this->assertEquals(3, $team->calculateGoalDifferential());
    }

    public function testCalculateShootoutWins()
    {
        $team = factory(\App\SportsDb\Team::class)->make();

        $homeGames = collect();
        $homeGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 1,
            'score2' => 1,
            'score1et' => 0,
            'score2et' => 0,
            'score1p' => 5,
            'score2p' => 4,
            'winner' => 1,
        ]));
        $homeGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 1,
            'score2' => 1,
            'winner' => 0,
        ]));
        $awayGames = collect();
        $awayGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 0,
            'score2' => 0,
            'winner' => 0,
        ]));
        $awayGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 1,
            'score2' => 1,
            'score1et' => 0,
            'score2et' => 1,
            'winner' => 2,
        ]));

        $team->setRelation('homeGames', $homeGames);
        $team->setRelation('awayGames', $awayGames);

        $this->assertEquals(1, $team->calculateShootoutWins());
    }

    public function testCalculateShutouts()
    {
        $team = factory(\App\SportsDb\Team::class)->make();

        $homeGames = collect();
        $homeGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 1,
            'score2' => 1,
            'score1et' => 0,
            'score2et' => 0,
            'score1p' => 5,
            'score2p' => 4,
            'winner' => 1,
        ]));
        $homeGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 1,
            'score2' => 1,
            'winner' => 0,
        ]));
        $awayGames = collect();
        $awayGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 0,
            'score2' => 0,
            'winner' => 0,
        ]));
        $awayGames->push(factory(\App\SportsDb\Game::class)->make([
            'score1' => 1,
            'score2' => 1,
            'score1et' => 0,
            'score2et' => 1,
            'winner' => 2,
        ]));

        $team->setRelation('homeGames', $homeGames);
        $team->setRelation('awayGames', $awayGames);

        $this->assertEquals(1, $team->calculateShutouts());
    }
}
