<?php

namespace Modules\User\Http\Controllers;

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

use Illuminate\Support\Arr;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class MachinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);
    }

    public function search_list(Request $request)
    {
        $filter = $request->input('filter');

        if ($filter == 'Todos') {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
                ->paginate(10);
        } else {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
                ->where('customers.name', 'LIKE', "%{$filter}%")
                ->orWhere('machines.status', 'LIKE', "%{$filter}%")
                ->paginate(10);
        }

        return view('user::machines.index', compact('machines', 'filter'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function search_gridview(Request $request)
    {
        $filter = $request->input('filter');

        if ($filter == 'Todos') {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
                ->get();
        } else {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
                ->where('customers.name', 'LIKE', "%{$filter}%")
                ->orWhere('machines.status', 'LIKE', "%{$filter}%")
                ->get();
        }

        return view('user::machines.index_grid', compact('machines', 'filter'));
    }

    public function createPDF(Request $request)
    {
        $machines = Machines::get();
        $machinesLength = count($machines);

        if ($request->has('download')) {
            $pdf = PDF::loadView('user::machines.createPDF', compact('machines', 'machinesLength'))->setPaper('a4', 'portrait')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            return $pdf->download('pdfview.pdf');
        }

        return view('user::machines.index', compact('machines'));
    }

    public function index()
    {
        $filter = null;
        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        // echo("<pre>");
        // print_r($machines);
        // echo("<\pre>");

        //exit;

        return view('user::machines.index', compact('machines', 'filter'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function grid_view_api()
    {
        $filter = null;

        // try {
        //     $client = new \GuzzleHttp\Client();
        //     //$response = $client->request('GET', 'https://pool.api.btc.com/v1/worker?access_key=r_1Jgynzble6tiF&puid=441429&status=active');
        //     $response = $client->get('https://pool.api.btc.com/v1/worker?access_key=r_1Jgynzble6tiF&puid=441429&status=active');

        //     if ($response->getStatusCode() == 200) {
        //         $response = json_decode($response->getBody(), true);
        //         dd($response);
        //     }
        // } catch (RequestException $e) {
        //     if ($e->getResponse()->getStatusCode() == '400') {
        //         echo "Got response 400";
        //     }
        // } catch (Exception $e) {
        //     //other errors 
        // }

        // exit();

        $cargaCli = [
            [
                'cdAccessKey' => 'r_1Jgynzble6tiF',
                'cdPuid' => '441429',
                'nmCli' => 'cliente 1'
            ],
        ];

        //return view('user::machines.index_grid_api', compact('filter', 'cargaCli'));


        foreach ($cargaCli as $listCargaCli) {

            //$api_response  = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker?access_key=' . $listCargaCli['cdAccessKey'] . '&puid=' . $listCargaCli['cdPuid']), true);
            $client = new \GuzzleHttp\Client();
            $api_response = $client->get('https://pool.api.btc.com/v1/worker?access_key=r_1Jgynzble6tiF&puid=441429&page_size=1000');
            $response = json_decode($api_response->getBody(), true);
            $collection = collect($response);
            dd($collection);

            echo 'cliente:' . $listCargaCli['nmCli'];
 
            // $array = data_get($api_response['data']['data'], '*.worker_name');
            // dd($array);
            // $api_response = Arr::pluck($api_response['data']['data'], 'worker_name','status');
            // dd($api_response);

            foreach ($api_response['data']['data'] as $listApi) {

                $array = data_get($listApi, '*.worker_name');
                $api_response = Arr::pluck($listApi, 'worker_name');
                dd($api_response);
                //echo 'machine name: ' . $listApi['worker_name'];
            }
        }


        exit;
    }

    public function grid_view()
    {
        $filter = null;
        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
            ->orderBy('id', 'DESC')
            ->get();

        // echo("<pre>");
        // print_r($machines);
        // echo("<\pre>");

        //exit;

        //dd($machines);

        return view('user::machines.index_grid', compact('machines', 'filter'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $customers = DB::table('customers')->get();
        $status = ['Encendido', 'Apagado', 'Mantenimiento', 'Requiere Atención', 'Error', 'Offline'];
        $machine = null;
        $codeQR = Str::random(8);
        $machine_changes  = null;

        return view('user::machines.create', compact('customers', 'status', 'machine', 'codeQR', 'machine_changes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20|min:4',
            'status' => 'required|max:30|min:5',
            'customer_id' => 'required',
            'codeQR' => 'required|max:20|min:5|unique:machines,codeQR',
            'observation' => 'nullable|max:200|min:5',
        ]);

        $input = $request->all();
        $input['user_id'] = $request->user()->id;
        $input['name'] = strtoupper($request->input('name'));
        Machines::create($input);

        return redirect()->route('machines.grid_view')->with('message', 'Machine created successfully.');
    }

    public function show($id)
    {
        $machine = DB::table('machines')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('customers.name AS customer_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation')
            ->where('machines.id', '=', $id)
            ->first();

        $machine_changes = DB::table('machines_history')
            ->leftjoin('machines', 'machines_history.machine_id', '=', 'machines.id')
            ->leftjoin('users', 'machines_history.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines_history.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines_history.created_at', 'machines_history.name', 'machines_history.created_at', 'machines_history.status', 'machines_history.observation', 'customers.name AS customer_name')
            ->where('machines_history.machine_id', '=', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        //to generate the qr code in the view from the obtained data
        $codeQR = $machine->codeQR;

        return view('user::machines.show', compact('machine', 'codeQR', 'machine_changes'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function edit($id)
    {
        $customers = Customers::all();
        $status = ['Encendido', 'Apagado', 'Mantenimiento', 'Requiere Atención', 'Error', 'Offline'];

        $machine = DB::table('machines')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('customers.name AS customer_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation')
            ->where('machines.id', '=', $id)
            ->first();

        $machine_changes = DB::table('machines_history')
            ->leftjoin('machines', 'machines_history.machine_id', '=', 'machines.id')
            ->leftjoin('users', 'machines_history.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines_history.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines_history.created_at', 'machines_history.name', 'machines_history.created_at', 'machines_history.status', 'machines_history.observation', 'customers.name AS customer_name')
            ->where('machines_history.machine_id', '=', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        //to generate the qr code in the view from the obtained data
        $codeQR = $machine->codeQR;

        return view('user::machines.edit', compact('machine', 'status', 'customers', 'codeQR', 'machine_changes'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:20|min:4',
            'status' => 'required|max:30|min:5',
            'customer_id' => 'required',
            'codeQR' => 'required|max:20|min:5|unique:machines,codeQR,' . $id,
            'observation' => 'nullable|max:200|min:5',
        ]);

        //find machine and create history machine actual status
        $machine = Machines::find($id);

        DB::table('machines_history')->insert(
            [
                'machine_id' => $id,
                'name' => $machine['name'],
                'status' => $machine['status'],
                'customer_id' => $machine['customer_id'],
                'user_id' => $machine['user_id'],
                'observation' => $machine['observation'],
                'created_at' => Carbon::now(),
            ]
        );

        //update machine
        $input = $request->all();
        $input['user_id'] = $request->user()->id;
        $input['name'] = strtoupper($request->input('name'));
        $machine = Machines::find($id);
        $machine->update($input);

        return redirect()->route('machines.edit', $id)->with('message', 'Machine updated successfully.');
    }

    public function destroy($id)
    {
        Machines::find($id)->delete();

        return redirect()->route('machines.index')->with('message', 'Machine deleted successfully');
    }
}
