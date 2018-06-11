<?php

namespace Tests\Unit;

use Tests\TestCase;

class EntryTest extends TestCase
{
    public function testCalculateGoals()
    {
        $entry = factory(\App\Entry::class)->make();

        $person = factory(\App\SportsDb\Person::class)->make();

        $goals = collect();
        $goals->push(factory(\App\SportsDb\Goal::class)->make());
        $goals->push(factory(\App\SportsDb\Goal::class)->make());

        $person->setRelation('goals', $goals);
        $persons = collect();
        $persons->push($person);

        $goals = $entry->calculateGoals($persons);

        $this->assertEquals(2, $goals);
    }
}
