<?php

namespace App\Console\Commands\Data;

use App\Team;
use App\Entry;
use App\Player;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\DatabaseManager;
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
     * The database connection for our database
     *
     * @var \Illuminate\Database\Connection
     */
    private $db;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DatabaseManager $manager)
    {
        parent::__construct();

        $this->db = $manager->connection();
    }

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

      $this->db->table('entry_team')->truncate();
      $this->db->table('entry_player')->truncate();
      foreach($values as $value) {
        $entry = Entry::create(['pool_id' => $value['pool'], 'name' => $value['name']]);
        foreach($value['teams'] as $key) {
          $team = Team::where(['key' => $key])->first();
          if (!$team) {
            $this->error("Cannot find team with key: $key");
          }
          $entry->teams()->attach($team);
        }
        if (array_key_exists('players', $value)) {
          foreach($value['players'] as $key) {
            $player = Player::where(['key' => $key])->first();
            if (!$player) {
              $this->error("Cannot find player with key: $key");
            }
            $entry->players()->attach($player);
          }
        }
      }

      return 0;
    }
}
