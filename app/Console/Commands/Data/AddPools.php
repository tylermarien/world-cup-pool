<?php

namespace App\Console\Commands\Data;

use App\Pool;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\Storage;

class AddPools extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:pools';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets up the pools';

    /**
     * The pools model
     *
     * @var \App\Pool
     */
    protected $pools;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Pool $pools)
    {
        parent::__construct();

        $this->pools = $pools;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $values = Yaml::parse(Storage::disk('data')->get('pools.yml'));
        } catch (ParseException $e) {
            $this->error('Could not load pools.yaml');
        }

        foreach($values as $value) {
            $this->pools->updateOrCreate(['id' => $value['id']], ['name' => $value['name']]);
        }

        return 0;
    }
}
