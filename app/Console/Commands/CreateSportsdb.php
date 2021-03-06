<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class CreateSportsdb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sportsdb:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new sportsdb';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // create sportdb
        $process = new Process('bundle exec sportdb -d storage/app new worldcup2018');
        $process->run();
    }
}
