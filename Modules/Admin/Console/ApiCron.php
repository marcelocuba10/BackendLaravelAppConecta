<?php

namespace Modules\Admin\Console;

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

            $created_at = \Carbon\Carbon::now();
            $worker_stats = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker/stats?access_key=' . $customer->access_key . '&puid=' . $customer->puid), true);
            $api_response  = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker?access_key=' . $customer->access_key . '&puid=' . $customer->puid . '&status=all&page_size=1000'), true);

            foreach ($api_response['data']['data'] as $listApi) {

                \DB::table('machines_api')->insert(
                    [
                        'worker_id' => $listApi['worker_id'],
                        'worker_name' => $listApi['worker_name'],
                        'shares_1m' => $listApi['shares_1m'],
                        'shares_5m' => $listApi['shares_5m'],
                        'shares_15m' => $listApi['shares_15m'],
                        'last_share_time' => $listApi['last_share_time'],
                        'last_share_ip' => $listApi['last_share_ip'],
                        'reject_percent' => $listApi['reject_percent'],
                        'first_share_time' => $listApi['first_share_time'],
                        'miner_agent' => $listApi['miner_agent'],
                        'shares_unit' => $listApi['shares_unit'],
                        'status' => $listApi['status'],
                        // 'shares_1m_pure' => $listApi['shares_1m_pure'],
                        // 'shares_5m_pure' => $listApi['shares_5m_pure'],
                        // 'shares_15m_pure' => $listApi['shares_15m_pure'],
                        'shares_1d' => $listApi['shares_1d'],
                        'shares_1d_unit' => $listApi['shares_1d_unit'],
                        'reject_percent_1d' => $listApi['reject_percent_1d'],
                        'created_at' => $created_at,
                        'customer_id' => $customer->id
                    ]
                );

                \Log::info("rows in machines_api is added!");
            }

            \DB::table('customers')->where('id', $customer->id)->update(
                [
                    'workers_active' => $worker_stats['data']['workers_active'],
                    'workers_inactive' => $worker_stats['data']['workers_inactive'],
                    'workers_dead' => $worker_stats['data']['workers_dead'],
                    'shares_1m' => $worker_stats['data']['shares_1m'],
                    'shares_5m' => $worker_stats['data']['shares_5m'],
                    'shares_15m' => $worker_stats['data']['shares_15m'],
                    'workers_total' => $worker_stats['data']['workers_total'],
                    'shares_unit' => $worker_stats['data']['shares_unit'],
                    'shares_1d' => $worker_stats['data']['shares_1d'],
                    'shares_1h' => $worker_stats['data']['shares_1h'],
                    'updated_at' => $created_at
                ]
            );
            \Log::info("rows in customers updated!");
        }
    }
}
