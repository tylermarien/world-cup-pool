<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class ImportPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the players from the sportsdb database into our database';

    /**
     * The database connection for our database
     *
     * @var \Illuminate\Database\Connection
     */
    private $db;

    /**
     * The database connection for the sportdb database
     *
     * @var \Illuminate\Database\Connection
     */
    private $sportdb;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DatabaseManager $manager)
    {
        parent::__construct();

        $this->db = $manager->connection('sqlite');
        $this->sportdb = $manager->connection('sportdb');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
