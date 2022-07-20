<?php

namespace Modules\User\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ApiCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'api:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

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
        \Log::info("Cron is working fine!");
        $this->info('Cake:Cron Command is working fine!');

        $customers = DB::table('customers')->get();

        foreach($customers as $customer){

            $api_response  = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker?access_key='.$customer->access_key.'&puid='.$customer->puid.'&status=all&page_size=1000'), true);
            foreach($api_response['data']['data'] as $listApi){

            }
        }

        
    }

}
