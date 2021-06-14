<?php

namespace App\Console\Commands\Data;

use App\Team;
use App\Entry;
use App\Player;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Exception\ParseException;

class AddEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:entries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reads in the entries from the yaml file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      try {
        $values = Yaml::parse(Storage::disk('data')->get('entries.yml'));
      } catch (ParseException $e) {
        $this->error('Could not load entries.yaml');
      }

      foreach($values as $value) {
        $entry = Entry::create(['pool_id' => 1, 'name' => $value['name']]);
        foreach($value['teams'] as $key) {
          $team = Team::where(['key' => $key])->first();
          $entry->teams()->attach($team);
        }
        foreach($value['players'] as $key) {
          $team = Player::where(['key' => $key])->first();
          $entry->players()->attach($team);
        }
      }

      return 0;
    }
}
