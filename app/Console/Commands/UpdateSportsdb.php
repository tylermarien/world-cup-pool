<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class UpdateSportsdb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sportsdb:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the sportsdb database';

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
        // update sportdb
        $process = new Process('bundle exec sportdb update');
        $process->run();
    }
}
