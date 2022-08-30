<?php

namespace Modules\Admin\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Customers;
use Modules\User\Entities\Machines;
use Illuminate\Support\Str;
use PDF;

class MachinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function cronjob()
    {
        $customers = DB::table('customers')
            ->select('customers.id', 'customers.name', 'customers.pool', 'customers.created_at', 'customers.totalWorkers', 'customers.total_machines', 'customers.userIdPool', 'customers.apiKey', 'customers.secretKey', 'customers.access_key', 'customers.puid')
            ->get();

        foreach ($customers as $customer) {

            $created_at = \Carbon\Carbon::now();

            if ($customer->pool == 'btc.com') {

                self::getDataFromApiBTC($customer, $created_at);
                
            } elseif ($customer->pool == 'antpool.com') {

                if ($customer->userIdPool && $customer->apiKey && $customer->secretKey) {

                    /** parameters to authenticate a request */
                    $page_size = $customer->total_machines;
                    $currency = 'BTC';
                    $userId = $customer->userIdPool;
                    $api_key = $customer->apiKey;
                    $api_secret = $customer->secretKey;
                    $typeUrl = 'hashrate';

                    /** Nonce is a regular integer number. It must be increasing with every request you make */
                    $nonce = time();

                    /** Signature is a HMAC-SHA256 */
                    $hmac_message = $userId . $api_key . $nonce;
                    $hmac = strtoupper(hash_hmac('sha256', $hmac_message, $api_secret, false));

                    /** create curl request */
                    $post_fields = array(
                        'key' => 'd36e7c47078f432aa52ee883d334f7bb',
                        'nonce' => $nonce,
                        'signature' => $hmac,
                        'coin' => $currency
                    );

                    $post_fields = array_merge($post_fields, array('pageSize' => $page_size));
                    $post_data = '';

                    foreach ($post_fields as $key => $value) {
                        $post_data .= $key . '=' . $value . '&';
                    }

                    rtrim($post_data, '&');

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://antpool.com/api/' . $typeUrl . '.htm');
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
                    curl_setopt($ch, CURLOPT_POST, count($post_fields));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    // set large timeout because API lak sometimes
                    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                    $result = curl_exec($ch);
                    curl_close($ch);

                    // check if curl was timed out
                    if ($result === false) {
                        if ($this->print_error_if_api_down) {
                            exit('Error: No API connect');
                        } else {
                            exit();
                        }
                    }

                    // validate JSON
                    $result_json = json_decode($result, true);

                    if ($result_json['message'] == 'ok') {
                        \DB::table('customers')->where('id', $customer->id)->update([
                            'last10m' => number_format(($result_json['data']['last10m'] / 1000000), 2),
                            'last30m' => number_format(($result_json['data']['last30m'] / 1000000), 2),
                            'last1h' => number_format(($result_json['data']['last1h'] / 1000000), 2),
                            'last1d' => $result_json['data']['last1d'],
                            'prev10m' => number_format(($result_json['data']['prev10m'] / 1000000), 2),
                            'prev30m' => number_format(($result_json['data']['prev30m'] / 1000000), 2),
                            'prev1h' => number_format(($result_json['data']['prev1h'] / 1000000), 2),
                            'prev1d' => number_format(($result_json['data']['prev1d'] / 1000000), 2),
                            'accepted' => $result_json['data']['accepted'],
                            'totalWorkers' => $result_json['data']['totalWorkers'],
                            'activeWorkers' => $result_json['data']['activeWorkers'],
                            'updated_at' => $created_at
                        ]);

                        \Log::info("customer: " . $customer->name . " stats info updated from: " . $customer->pool);

                        /** call function to get all workers */
                        self::getDataFromApiANTPOOL($customer, $created_at);
                    }
                }
            }
        }

        return json_encode('complete');
    }

    public function getDataFromApiBTC($customer, $created_at)
    {
        if ($customer->access_key && $customer->puid) {

            $worker_stats = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker/stats?access_key=' . $customer->access_key . '&puid=' . $customer->puid), true);

            if ($worker_stats['err_no'] != 10010) {
                $api_response  = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker?access_key=' . $customer->access_key . '&puid=' . $customer->puid . '&status=all&page_size=1000'), true);

                foreach ($api_response['data']['data'] as $listApi) {
                    \DB::table('machines_api')->insert([
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
                    ]);

                    \Log::info("customer: " . $customer->name . " machine: " . $listApi['worker_name'] . " added in machines_api");
                }

                \DB::table('customers')->where('id', $customer->id)->update([
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
                ]);

                \Log::info("customer: " . $customer->name . " stats info updated from: " . $customer->pool);
            }
        }

        return;
    }

    public function getDataFromApiANTPOOL($customer, $created_at)
    {
        /** parameters to authenticate a request */
        $page_size = $customer->totalWorkers;
        $currency = 'BTC';
        $userId = $customer->userIdPool;
        $api_key = $customer->apiKey;
        $api_secret = $customer->secretKey;
        $typeUrl = 'workers';

        /** Nonce is a regular integer number. It must be increasing with every request you make */
        $nonce = time();

        /** Signature is a HMAC-SHA256 */
        $hmac_message = $userId . $api_key . $nonce;
        $hmac = strtoupper(hash_hmac('sha256', $hmac_message, $api_secret, false));

        /** create curl request */
        $post_fields = array(
            'key' => 'd36e7c47078f432aa52ee883d334f7bb',
            'nonce' => $nonce,
            'signature' => $hmac,
            'coin' => $currency
        );

        $post_fields = array_merge($post_fields, array('pageSize' => $page_size));
        $post_data = '';

        foreach ($post_fields as $key => $value) {
            $post_data .= $key . '=' . $value . '&';
        }

        rtrim($post_data, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://antpool.com/api/' . $typeUrl . '.htm');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($ch, CURLOPT_POST, count($post_fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // set large timeout because API lak sometimes
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $result = curl_exec($ch);
        curl_close($ch);

        // check if curl was timed out
        if ($result === false) {
            if ($this->print_error_if_api_down) {
                exit('Error: No API connect');
            } else {
                exit();
            }
        }

        // validate JSON
        $result_json = json_decode($result, true);

        if ($result_json['message'] == 'ok') {

            /** save in DB table machines_api */
            $created_at = \Carbon\Carbon::now();

            foreach ($result_json['data']['rows'] as $listApi) {
                DB::table('machines_api')->insert([
                    'worker' => substr($listApi['worker'], 5), // remove firts 5 characters to string 
                    'last10m' => number_format(($listApi['last10m'] / 1000000), 2),
                    'last30m' => number_format(($listApi['last30m'] / 1000000), 2),
                    'last1h' => number_format(($listApi['last1h'] / 1000000), 2),
                    'last1d' => number_format(($listApi['last1d'] / 1000000), 2),
                    'prev10m' => number_format(($listApi['prev10m'] / 1000000), 2),
                    'prev30m' => number_format(($listApi['prev30m'] / 1000000), 2),
                    'prev1h' => number_format(($listApi['prev1h'] / 1000000), 2),
                    'prev1d' => number_format(($listApi['prev1d'] / 1000000), 2),
                    'created_at' => $created_at,
                    'customer_id' => $customer->id
                ]);

                \Log::info("customer: " . $customer->name . " machine: " . $listApi['worker'] . " added in machines_api");
            }
        } else {
            exit('API Error: ' . print_r($result_json, true));
        }

        return;
    }
}
