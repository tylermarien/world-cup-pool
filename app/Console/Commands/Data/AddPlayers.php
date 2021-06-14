<?php

namespace App\Console\Commands\Data;

use App\Team;
use App\Player;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Exception\ParseException;

class AddPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reads in the players from the yaml file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      try {
        $values = Yaml::parse(Storage::disk('data')->get('players.yml'));
      } catch (ParseException $e) {
        $this->error('Could not load entries.yaml');
      }

      foreach($values as $value) {
        $this->info("Adding {$value['name']}");
        $team = Team::where(['key' => $value['team']])->first();
        Player::create(['key' => $value['key'], 'name' => $value['name'], 'team_id' => $team->id]);
      }

      return 0;
    }
}
