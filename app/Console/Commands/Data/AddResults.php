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
     * @var Entry
     */
    protected Entry $entries;

    /**
     * @var Team
     */
    protected Team $teams;

    /**
     * @var Player
     */
    protected Player $players;

    /**
     * @param Entry $entries
     * @param Team $teams
     * @param Player $players
     */
    public function __construct(Entry $entries, Team $teams, Player $players)
    {
      parent::__construct();

      $this->entries = $entries;
      $this->teams = $teams;
      $this->players = $players;
    }

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

      $this->validateYaml($values);

      $this->teams->all()->each(function ($team) use ($values) {
        $games = array_filter($values, fn($value) => $value['home'] === $team->key || $value['away'] === $team->key);

        $games_played = count($games);
        $wins = 0;
        $ties = 0;
        $goals_for = 0;
        $goals_against = 0;
        $shootout_wins = 0;
        $shutouts = 0;
        foreach($games as $value) {
          $home_goals = !isset($value['goals']) ? 0 : array_reduce($value['goals'], function ($previous, $goal) use ($value) {
            if ($goal['team'] === $value['home']) {
              return $previous + 1;
            }

            return $previous;
          }, 0);

          $away_goals = !isset($value['goals']) ? 0 : array_reduce($value['goals'], function ($previous, $goal) use ($value) {
            if ($goal['team'] === $value['away']) {
              return $previous + 1;
            }

            return $previous;
          }, 0);

          if ($home_goals === $away_goals) {
            if (isset($value['shootout_winner'])) {
              if ($value['shootout_winner'] === $team->key) {
                $wins++;
                $shootout_wins++;
              }
            } else {
              $ties++;
            }
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
          'shootout_wins' => $shootout_wins,
          'shutouts' => $shutouts,
        ]);
      });

      $this->players->all()->each(function ($player) use ($values) {
        $goals = array_reduce($values, function($previous, $value) use ($player) {
          if (!isset($value['goals'])) {
            return $previous;
          }

          return $previous + array_reduce($value['goals'], function ($previous, $goal) use ($player) {
            if (iconv('utf8', 'ASCII//TRANSLIT', $goal['player']) === iconv('utf8', 'ASCII//TRANSLIT', $player->key)) {
              return $previous + 1;
            }

            return $previous;
          }, 0);
        }, 0);

        $player->update(['goals' => $goals]);
        if ($goals > 0) {
          $this->info("{$player->name} has {$goals} goals");
        }
      });

      $this->entries->all()->each(function ($entry) {
        $entry->total = $entry->calculateTotal();
        $entry->save();
      });

      return 0;
    }

    protected function validateYaml(array $games): void
    {
      foreach($games as $game) {
        $home = $this->teams->where('key', $game['home'])->first();
        if (is_null($home)) {
          $this->error("{$value['home']} does not map to a team");
        }

        $away = $this->teams->where('key', $game['away'])->first();
        if (is_null($away)) {
          $this->error("{$game['away']} does not map to a team");
        }

        if (isset($game['goals'])) {
          foreach($game['goals'] as $goal) {
            $player = $this->players->where('key', $goal['player'])->first();

            if ($goal['team'] !== $game['home'] && $goal['team'] !== $game['away']) {
              $this->error("{$goal['team']} does not map to one of the participating teams");
            }

            if (is_null($player)) {
              $this->warn("{$goal['player']} does not map to a player");
            }
          }
        }
      }
    }
}
