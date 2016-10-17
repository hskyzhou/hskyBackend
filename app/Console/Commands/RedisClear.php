<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use LaraveRedis;

class RedisClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:clear {namespace=hsky}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear redis';

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
        /*获取参数*/
        $namespace = $this->argument('namespace');
        /*获取选项*/
        // $this->option('mark')

        $key = $namespace . "*";

        if(LaraveRedis::command('KEYS', [$key])){
            if(LaraveRedis::command('DEL', LaraveRedis::command('KEYS', [$key]))){
                $this->info('redis clear complete');
            }
        }

        $this->info('no redis');
    }
}
