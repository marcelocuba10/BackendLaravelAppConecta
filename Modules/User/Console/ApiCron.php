<?php

namespace Modules\User\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use DB;

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

        $customers = DB::table('customers')->get();

        foreach ($customers as $customer) {

            $api_response  = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker?access_key=' . $customer->access_key . '&puid=' . $customer->puid . '&status=all&page_size=1000'), true);

            foreach ($api_response['data']['data'] as $listApi) {

                $created_at = \Carbon\Carbon::now();

                // \DB::table('machines_api')->insert([
                //     ['json_data' => $api_response, 'created_at' => $created_at]
                // ]);

                // $input = $api_response['data']['data']->all();
                // $input['customer_id'] = $customer['id'];
                // $input['created_at'] = $created_at;
                // Machines::create($input);

                 \DB::table('machines_api')->insert(
                    [
                        'worker_id' => $listApi['worker_id'],
                        'worker_name' => $listApi['worker_name'],
                        'shares_1m' => $listApi['shares_1m'],
                        'shares_5m' => $listApi['shares_5m'],
                        'shares_15m' => $listApi['shares_15m'],
                        'last_share_time' => $listApi['last_share_time'],
                        'last_share_ip' => $listApi['last_share_ip'],
                        'reject_percent'=> $listApi['reject_percent'],
                        'first_share_time' => $listApi['first_share_time'],
                        'miner_agent' => $listApi['miner_agent'],
                        'shares_unit' => $listApi['shares_unit'],
                        'status' => $listApi['status'],
                        'shares_1m_pure' => $listApi['shares_1m_pure'],
                        'shares_5m_pure' => $listApi['shares_5m_pure'],
                        'shares_15m_pure' => $listApi['shares_15m_pure'],
                        'shares_1d' => $listApi['shares_1d'],
                        'shares_1d_unit' => $listApi['shares_1d_unit'],
                        'reject_percent_1d' => $listApi['reject_percent_1d'],
                        'created_at' => $created_at,
                        'customer_id' => $customer->id
                    ]
                );

                \Log::info("Cron is working fine!");
                
            }
        }
    }
}
