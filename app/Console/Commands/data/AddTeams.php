<?php

namespace App\Console\Commands\Data;

use App\Team;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Exception\ParseException;

class AddTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:teams';

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
        $values = Yaml::parse(Storage::disk('data')->get('teams.yml'));
      } catch (ParseException $e) {
        $this->error('Could not load entries.yaml');
      }

      foreach($values as $value) {
        $this->info("key: {$value['key']}, name: {$value['name']}");
        Team::create(['key' => $value['key'], 'name' => $value['name']]);
      }

      return 0;
    }
}
