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
     * @var Team
     */
    protected $teams;

    /**
     * @param Team
     */
    public function __construct(Team $teams)
    {
      parent::__construct();

      $this->teams = $teams;
    }

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
        $this->teams->updateOrCreate(['key' => $value['key']], [
          'name' => $value['name'],
          'pool_placing' => isset($value['pool_placing']) ? intval($value['pool_placing']) : null,
          'final_placing' => isset($value['final_placing']) ? intval($value['final_placing']) : null,
          'eliminated' => isset($value['eliminated']) && $value['eliminated'],
        ]);
      }

      return 0;
    }
}
