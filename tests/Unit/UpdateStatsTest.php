<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Console\Commands\UpdateStats;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateStatsTest extends TestCase
{
    public function testCalculateWins()
    {
        $command = $this->app->make(UpdateStats::class);

        $points = $command->calculateWins(collect(), collect());

        $this->assertEquals(0, $total);
    }
}
