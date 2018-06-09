<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RebuildTestDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:rebuild';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuilds the test database';

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
        Artisan::call('migrate:fresh', [
            '--database' => 'sqlite',
        ]);
        Artisan::call('import:teams');
        Artisan::call('db:seed');
    }
}
