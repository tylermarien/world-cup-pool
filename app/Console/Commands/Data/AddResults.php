<?php

namespace App\Console\Commands\Data;

use App\Team;
use App\Entry;
use App\Player;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Exception\ParseException;

class AddResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reads in the results from the yaml file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      try {
        $values = Yaml::parse(Storage::disk('data')->get('results.yml'));
      } catch (ParseException $e) {
        $this->error('Could not load entries.yaml');
      }

      Team::all()->each(function ($team) use ($values) {
        $games = array_filter($values, fn($value) => $value['home'] === $team->key || $value['away'] === $team->key);

        $games_played = count($games);
        $wins = 0;
        $ties = 0;
        $goals_for = 0;
        $goals_against = 0;
        $shutouts = 0;
        foreach($games as $value) {
          $home_goals = array_reduce($value['goals'], function ($previous, $goal) use ($value) {
            if ($goal['team'] === $value['home']) {
              return $previous + 1;
            }

            return $previous;
          }, 0);

          $away_goals = array_reduce($value['goals'], function ($previous, $goal) use ($value) {
            if ($goal['team'] === $value['away']) {
              return $previous + 1;
            }

            return $previous;
          }, 0);

          if ($home_goals === $away_goals) {
            $ties++;
          }

          if ($value['home'] === $team->key) {
            $goals_for += $home_goals;
            $goals_against += $away_goals;

            if ($home_goals > $away_goals) {
              $wins++;
            }

            if ($away_goals === 0) {
              $shutouts++;
            }
          }

          if ($value['away'] === $team->key) {
            $goals_for += $away_goals;
            $goals_against += $home_goals;

            if ($home_goals < $away_goals) {
              $wins++;
            }

            if ($home_goals === 0) {
              $shutouts++;
            }
          }
        }

        $goal_differential = $goals_for - $goals_against;
        $this->info("{$team->name} has {$games_played} games played, {$wins} wins, {$ties} ties, {$goal_differential} goal differential. {$shutouts} shutouts");

        $team->update([
          'games_played' => $games_played,
          'wins' => $wins,
          'ties' => $ties,
          'goal_differential' => $goal_differential,
          'shutouts' => $shutouts,
        ]);
      });

      Entry::all()->each(function ($entry) {
        $entry->total = $entry->calculateTotal();
        $entry->save();
      });

      return 0;
    }
}
