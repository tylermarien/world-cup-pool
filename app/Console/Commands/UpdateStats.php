<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Entry;
use App\SportsDb\Game;
use App\SportsDb\Team;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Symfony\Component\Process\Process;
use Illuminate\Database\DatabaseManager;

class UpdateStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates stats from sportsdb database and updates our database';

    /**
     * The Entry model
     *
     * @var \App\Entry
     */
    protected $entries;

    /**
     * Create a new command instance.
     *
     * @param Entry $entries
     *
     * @return void
     */
    public function __construct(Entry $entries)
    {
        parent::__construct();

        $this->entries = $entries;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('sportsdb:delete');
        $this->call('sportsdb:create');

        $this->entries->all()->each(function ($entry) {
            $entry->total = $entry->calculateTotal();
            $entry->save();
        });
    }
}
