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

class MachinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);

        $this->middleware('permission:machine-list|machine-create|machine-edit|machine-delete', ['only' => ['index']]);
        $this->middleware('permission:machine-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:machine-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:machine-delete', ['only' => ['destroy']]);
    }

    public function index_list()
    {
        $filter = null;
        $idRefCurrentUser = Auth::user()->idReference;
        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.total_power', 'machines.mining_power', 'machines.status', 'customers.name AS customer_name')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->orderBy('id', 'DESC')
            ->paginate(15);

        return view('user::machines.index_list', compact('machines', 'filter'))->with('i', (request()->input('page', 1) - 1) * 15);
    }

    public function index_list_api()
    {
        $filter = null;
        $idRefCurrentUser = Auth::user()->idReference;
        $machines_api = DB::table('machines_api')
            ->leftjoin('customers', 'machines_api.customer_id', '=', 'customers.id')
            ->select(
                'machines_api.id',
                'customers.name AS customer_name',
                'customers.pool AS customer_pool',
                'machines_api.worker_name',
                'machines_api.shares_1m',
                'machines_api.shares_5m',
                'machines_api.shares_15m',
                'machines_api.shares_1h',
                'machines_api.shares_1d',
                'machines_api.status',
                'machines_api.last_share_time',
                'machines_api.first_share_time',
                'machines_api.miner_agent',
                'machines_api.worker',
                'machines_api.last10m',
                'machines_api.last30m',
                'machines_api.last1h',
                'machines_api.last1d',
            )
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->orderBy('machines_api.created_at', 'DESC')
            ->paginate(20);

        return view('user::machines.index_list_api', compact('machines_api', 'filter'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function grid_view()
    {
        $filter = null;
        $idRefCurrentUser = Auth::user()->idReference;
        $customers = DB::table('customers')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->select('customers.id', 'customers.name', 'customers.phone', 'customers.total_machines', 'customers.address', 'customers.totalWorkerNum', 'customers.activeWorkerNum', 'customers.inactiveWorkerNum', 'customers.invalidWorkerNum')
            ->get();

        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation')
            ->orderBy('machines.created_at', 'DESC')
            ->get();

        return view('user::machines.index_grid', compact('machines', 'customers', 'filter'));
    }

    public function grid_view_api(Request $request)
    {
        $idRefCurrentUser = Auth::user()->idReference;
        $customers = DB::table('customers')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->select(
                'customers.id',
                'customers.name',
                'customers.pool',
                'customers.apiKey',
                'customers.secretKey',
                'customers.userIdPool',
                'customers.access_key',
                'customers.puid',
                'customers.total_machines',

                'customers.totalWorkerNum',
                'customers.activeWorkerNum',
                'customers.inactiveWorkerNum',
                'customers.invalidWorkerNum',

                'customers.workers_total',
                'customers.workers_active',
                'customers.workers_inactive',
                'customers.workers_dead',
                'customers.updated_at'
            )
            ->paginate(1);

        /** if the pagination does not have more users */
        if ($customers->count() == 0) {
            $machines = null; //return null for break ajax scroll
        } else {
            if ($customers[0]->pool == 'antpool.com') {
                if ($customers[0]->userIdPool && $customers[0]->apiKey && $customers[0]->secretKey) {
                    $machines = DB::table('machines_api')
                        ->select('machines_api.id', 'machines_api.worker', 'machines_api.last10m')
                        ->where('machines_api.customer_id', '=', $customers[0]->id)
                        ->orderBy('created_at', 'DESC')
                        ->take($customers[0]->totalWorkerNum)
                        ->get();
                } else {
                    $machines = DB::table('machines_api')
                        ->select('machines_api.id', 'machines_api.worker', 'machines_api.last10m')
                        ->where('machines_api.customer_id', '=', $customers[0]->id)
                        ->orderBy('created_at', 'DESC')
                        ->take($customers[0]->total_machines)
                        ->get();
                }
            }

            if ($customers[0]->pool == 'btc.com') {
                if ($customers[0]->access_key && $customers[0]->puid) {
                    $machines = DB::table('machines_api')
                        ->select('machines_api.id', 'machines_api.worker_name', 'machines_api.status')
                        ->where('machines_api.customer_id', '=', $customers[0]->id)
                        ->orderBy('created_at', 'DESC')
                        ->take($customers[0]->workers_total)
                        ->get();
                } else {
                    $machines = DB::table('machines_api')
                        ->select('machines_api.id', 'machines_api.worker_name', 'machines_api.status')
                        ->where('machines_api.customer_id', '=', $customers[0]->id)
                        ->orderBy('created_at', 'DESC')
                        ->take($customers[0]->total_machines)
                        ->get();
                }
            }

            if ($customers[0]->pool == 'binance.com') {
                $machines = DB::table('machines_api')
                    ->select('machines_api.id', 'machines_api.worker_name', 'machines_api.status')
                    ->where('machines_api.customer_id', '=', $customers[0]->id)
                    ->orderBy('created_at', 'DESC')
                    ->take($customers[0]->total_machines)
                    ->get();
            }

            if ($customers[0]->pool == 'poolin.com') {
                $machines = DB::table('machines_api')
                    ->select('machines_api.id', 'machines_api.worker_name', 'machines_api.status')
                    ->where('machines_api.customer_id', '=', $customers[0]->id)
                    ->orderBy('created_at', 'DESC')
                    ->take($customers[0]->total_machines)
                    ->get();
            }

            /** if the user does not have any machine */
            if ($machines->count() == 0) {
                $machines = null; //return null for break ajax scroll
            }
        }

        if ($request->ajax()) {
            if ($machines != null) {
                $view = view('user::machines._partials.data', compact('machines', 'customers'))->render();
            } else {
                $view = view('user::machines._partials.data', compact('machines', 'customers'))->render();
            }

            return response()->json(['html' => $view]);
        }

        return view('user::machines.index_grid_api');
    }

    public function search_filter_list(Request $request)
    {
        $filter = $request->input('filter');
        $idRefCurrentUser = Auth::user()->idReference;

        if ($filter == '') {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.total_power', 'machines.mining_power', 'machines.status', 'customers.name AS customer_name')
                ->where('customers.idReference', '=', $idRefCurrentUser)
                ->paginate(30);
        } else {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.total_power', 'machines.mining_power', 'machines.status', 'customers.name AS customer_name')
                ->where('customers.name', 'LIKE', "%{$filter}%")
                ->orWhere('machines.name', 'LIKE', "%{$filter}%")
                ->orWhere('machines.status', 'LIKE', "{$filter}")
                ->where('customers.idReference', '=', $idRefCurrentUser)
                ->paginate(30);
        }

        return view('user::machines.index_list', compact('machines', 'filter'))->with('i', (request()->input('page', 1) - 1) * 30);
    }

    public function search_filter_list_api(Request $request)
    {
        $filter = $request->input('filter');
        $idRefCurrentUser = Auth::user()->idReference;
        $countMachines = 0;

        if ($filter == '') {

            $customers = DB::table('customers')
                ->select(
                    'customers.id',
                    'customers.name',
                    'customers.total_machines',
                    'customers.pool',
                    'customers.workers_total',
                    'customers.totalWorkerNum',
                    'customers.activeWorkerNum',
                    'customers.inactiveWorkerNum',
                    'customers.invalidWorkerNum',
                    'customers.workers_total',
                    'customers.workers_active',
                    'customers.workers_inactive',
                    'customers.workers_dead',
                )
                ->where('customers.idReference', '=', $idRefCurrentUser)
                ->get();

            foreach ($customers as $customer) {
                if ($customer->pool == "btc.com") {
                    $countMachines += $customer->workers_active;
                } elseif ($customer->pool == "antpool.com") {
                    $countMachines += $customer->workers_active;
                }
            }

            $machines_api = DB::table('machines_api')
                ->leftjoin('customers', 'machines_api.customer_id', '=', 'customers.id')
                ->select(
                    'machines_api.id',
                    'machines_api.worker_name',
                    'customers.name AS customer_name',
                    'customers.pool AS customer_pool',
                    'machines_api.status',
                    'machines_api.shares_1m',
                    'machines_api.shares_5m',
                    'machines_api.shares_15m',
                    'machines_api.shares_1h',
                    'machines_api.shares_1d',
                    'machines_api.worker',
                    'machines_api.last10m',
                    'machines_api.last30m',
                    'machines_api.last1h',
                    'machines_api.last1d',
                )
                ->where('customers.idReference', '=', $idRefCurrentUser)
                ->paginate(30);
        } else {
            $machines_api = DB::table('machines_api')
                ->leftjoin('customers', 'machines_api.customer_id', '=', 'customers.id')
                ->select(
                    'machines_api.id',
                    'machines_api.worker_name',
                    'customers.name AS customer_name',
                    'customers.pool AS customer_pool',
                    'machines_api.status',
                    'machines_api.shares_1m',
                    'machines_api.shares_5m',
                    'machines_api.shares_15m',
                    'machines_api.shares_1h',
                    'machines_api.shares_1d',
                    'machines_api.worker',
                    'machines_api.last10m',
                    'machines_api.last30m',
                    'machines_api.last1h',
                    'machines_api.last1d',
                )
                ->where('customers.name', 'LIKE', "%{$filter}%")
                ->orWhere('machines_api.worker_name', 'LIKE', "%{$filter}%")
                ->orWhere('machines_api.status', 'LIKE', "{$filter}")
                ->where('customers.idReference', '=', $idRefCurrentUser)
                ->paginate(30);
        }

        return view('user::machines.index_list_api', compact('machines_api', 'filter'))->with('i', (request()->input('page', 1) - 1) * 30);
    }

    public function search_gridview(Request $request)
    {
        $filter = null;
        $search = $request->input('search');
        $idRefCurrentUser = Auth::user()->idReference;

        $customers = DB::table('customers')
            ->select('customers.id', 'customers.name', 'customers.access_key', 'customers.puid')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->get();

        if ($search == '') {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
                ->get();
        } else {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
                ->where('customers.name', 'LIKE', "%{$search}%")
                ->orWhere('machines.name', 'LIKE', "%{$search}%")
                ->get();
        }

        return view('user::machines.index_grid', compact('search', 'customers', 'machines', 'filter'));
    }

    public function search_gridview_api(Request $request)
    {
        $filter = null;
        $status = "all";
        $search = $request->input('search');
        $idRefCurrentUser = Auth::user()->idReference;

        $customers = DB::table('customers')
            ->select('customers.id', 'customers.name', 'customers.access_key', 'customers.puid')
            ->where('customers.name', 'LIKE', "%{$search}%")
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->get();

        return view('user::machines.results', compact('customers'))->with(['search' => $request->search])->render();

        // if ($request->ajax()) {
        //     $view = view('user::machines._partials.data', compact('customers', 'status'))->render();
        //     return response()->json(['html' => $view]);
        // }

        // return view('user::machines.index_grid_api', compact('search', 'customers', 'filter', 'status'));
    }

    public function filter_gridview(Request $request)
    {
        $filter = $request->input('filter');
        $idRefCurrentUser = Auth::user()->idReference;
        $customers = DB::table('customers')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->select('customers.id', 'customers.name', 'customers.phone', 'customers.total_machines', 'customers.address')
            ->get();

        if ($filter == "") {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
                ->where('customers.idReference', '=', $idRefCurrentUser)
                ->get();
        } else {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
                ->where('machines.status', 'LIKE', "{$filter}")
                ->where('customers.idReference', '=', $idRefCurrentUser)
                ->get();
        }

        return view('user::machines.index_grid', compact('filter', 'customers', 'machines'));
    }

    public function filter_gridview_api(Request $request)
    {
        $filter = $request->input('filter');
        $idRefCurrentUser = Auth::user()->idReference;
        $customers = DB::table('customers')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->select(
                'customers.id',
                'customers.name',
                'customers.pool',
                'customers.apiKey',
                'customers.secretKey',
                'customers.userIdPool',
                'customers.access_key',
                'customers.puid',
                'customers.total_machines',

                'customers.totalWorkerNum',
                'customers.activeWorkerNum',
                'customers.inactiveWorkerNum',
                'customers.invalidWorkerNum',

                'customers.workers_total',
                'customers.workers_active',
                'customers.workers_inactive',
                'customers.workers_dead'
            )
            ->paginate(1);

        /** if the pagination does not have more users */
        if ($customers->count() == 0) {
            $machines = null; //return null for break ajax scroll
        } else {

            if ($filter == "active" || $filter == "inactive") {
                $machines = DB::table('machines_api')
                    ->select('machines_api.id', 'machines_api.worker_name', 'machines_api.status')
                    ->where('machines_api.customer_id', '=', $customers[0]->id)
                    ->where('machines_api.status', 'LIKE', "{$filter}")
                    ->where('customers.idReference', '=', $idRefCurrentUser)
                    ->orderBy('created_at', 'DESC')
                    ->take($customers[0]->total_machines)
                    ->get();
            } else {
                $machines = DB::table('machines_api')
                    ->select('machines_api.id', 'machines_api.worker_name', 'machines_api.status')
                    ->where('machines_api.customer_id', '=', $customers[0]->id)
                    ->where('customers.idReference', '=', $idRefCurrentUser)
                    ->orderBy('created_at', 'DESC')
                    ->take($customers[0]->total_machines)
                    ->get();
            }

            /** if the user does not have any machine */
            if ($machines->count() == 0) {
                $machines = null; //return null for break ajax scroll
            }
        }

        if ($request->ajax()) {
            $view = view('user::machines._partials.data', compact('machines', 'customers'))->render();
            return response()->json(['html' => $view]);
        }

        return view('user::machines.index_grid_api', compact('filter'));
    }

    public function show($id)
    {
        $machine = DB::table('machines')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('customers.name AS customer_name', 'customers.total_machines', 'customers.pool AS customer_pool', 'customers.id AS customer_id', 'machines.id', 'machines.name', 'machines.total_power', 'machines.mining_power', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation')
            ->where('machines.id', '=', $id)
            ->first();

        if ($machine->customer_pool == 'btc.com') {
            $machine_api = DB::table('machines_api')
                ->select('machines_api.id', 'machines_api.shares_1m', 'machines_api.worker_name', 'machines_api.created_at')
                ->where('machines_api.worker_name', '=', $machine->name)
                ->orderBy('created_at', 'DESC')
                ->take(1)
                ->first();
        } elseif ($machine->customer_pool == 'antpool.com') {
            $machine_api = DB::table('machines_api')
                ->select('machines_api.id', 'machines_api.last10m', 'machines_api.worker', 'machines_api.created_at')
                ->where('machines_api.worker', '=', $machine->name)
                ->orderBy('created_at', 'DESC')
                ->take(1)
                ->first();
        } else {
            $machine_api = null;
        }

        $machine_changes = DB::table('machines_history')
            ->leftjoin('machines', 'machines_history.machine_id', '=', 'machines.id')
            ->leftjoin('users', 'machines_history.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines_history.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines_history.created_at', 'machines_history.name', 'machines_history.mining_power', 'machines_history.total_power', 'machines_history.created_at', 'machines_history.status', 'machines_history.observation', 'customers.name AS customer_name')
            ->where('machines_history.machine_id', '=', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        //to generate the qr code in the view from the obtained data
        $codeQR = $machine->codeQR;

        return view('user::machines.show', compact('machine', 'codeQR', 'machine_changes', 'machine_api'));
    }

    public function show_api($id)
    {
        $machine = DB::table('machines_api')
            ->leftjoin('customers', 'machines_api.customer_id', '=', 'customers.id')
            ->select(
                'customers.name AS customer_name',
                'customers.pool AS customer_pool',
                'machines_api.id',
                'machines_api.worker_name',
                'machines_api.shares_1m',
                'machines_api.shares_5m',
                'machines_api.shares_15m',
                'machines_api.shares_1h',
                'machines_api.shares_1d',
                'machines_api.status',
                'machines_api.last_share_time',
                'machines_api.first_share_time',
                'machines_api.miner_agent',
                'machines_api.worker',
                'machines_api.last10m',
                'machines_api.last30m',
                'machines_api.last1h',
                'machines_api.last1d'
            )
            ->where('machines_api.id', '=', $id)
            ->first();

        return view('user::machines.show_api', compact('machine'));
    }

    public function create()
    {
        $idRefCurrentUser = Auth::user()->idReference;
        $customers = DB::table('customers')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->select('customers.id', 'customers.name')
            ->get();

        $status = ['ACTIVE', 'Apagado', 'Mantenimiento', 'Requiere Atención', 'Error', 'INACTIVE'];
        $mining_power_options = ['Megahash', 'Gigahash', 'Terahash', 'Pentahash'];
        $machine = null;

        //$codeQR = Str::random(8);
        $codeQR = $this->generateUniqueCodeQR();
        $machine_changes  = null;

        return view('user::machines.create', compact('customers', 'status', 'machine', 'codeQR', 'machine_changes', 'mining_power_options'));
    }

    public function generateUniqueCodeQR()
    {
        do {
            $codeQR = random_int(10000000, 99999999);
        } while (Machines::where("codeQR", "=", $codeQR)->first());

        return $codeQR;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:15|min:8|unique:machines,name',
            'status' => 'required|max:30|min:5',
            'customer_id' => 'required',
            'codeQR' => 'required|max:8|min:8|unique:machines,codeQR',
            'observation' => 'nullable|max:200|min:5',
            'mining_power' => 'nullable|max:15|min:5',
            'total_power' => 'nullable|max:20|between:0,9999|numeric|min:0',
        ]);

        $input = $request->all();
        $input['user_id'] = $request->user()->id;
        //$input['name'] = strtoupper($request->input('name'));
        Machines::create($input);

        return redirect()->route('machines.grid_view')->with('message', 'Machine created successfully.');
    }

    public function edit($id)
    {
        $idRefCurrentUser = Auth::user()->idReference;
        $customers = DB::table('customers')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->select('customers.id', 'customers.name')
            ->get();

        $status = ['ACTIVE', 'Apagado', 'Mantenimiento', 'Requiere Atención', 'Error', 'INACTIVE'];
        $mining_power_options = ['Megahash', 'Gigahash', 'Terahash', 'Pentahash'];

        $machine = DB::table('machines')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('customers.name AS customer_name', 'machines.id', 'machines.name', 'machines.mining_power', 'machines.total_power', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation')
            ->where('machines.id', '=', $id)
            ->first();

        $machine_changes = DB::table('machines_history')
            ->leftjoin('machines', 'machines_history.machine_id', '=', 'machines.id')
            ->leftjoin('users', 'machines_history.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines_history.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines_history.created_at', 'machines_history.name', 'machines_history.mining_power', 'machines_history.total_power', 'machines_history.created_at', 'machines_history.status', 'machines_history.observation', 'customers.name AS customer_name')
            ->where('machines_history.machine_id', '=', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        //to generate the qr code in the view from the obtained data
        $codeQR = $machine->codeQR;

        return view('user::machines.edit', compact('machine', 'status', 'customers', 'codeQR', 'machine_changes', 'mining_power_options'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:15|min:8|unique:machines,name,' . $id,
            'status' => 'required|max:30|min:5',
            'customer_id' => 'required',
            'codeQR' => 'required|max:8|min:8|unique:machines,codeQR,' . $id,
            'observation' => 'nullable|max:200|min:5',
            'mining_power' => 'nullable|max:15|min:5',
            'total_power' => 'nullable|max:20|between:0,9999|numeric|min:0',
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
        //$input['name'] = strtoupper($request->input('name'));
        $machine = Machines::find($id);
        $machine->update($input);

        return redirect()->route('machines.edit', $id)->with('message', 'Machine updated successfully.');
    }

    public function createPDF(Request $request)
    {
        $idRefCurrentUser = Auth::user()->idReference;
        $machines = DB::table('machines')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('machines.id', 'machines.name', 'machines.codeQR')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->get();

        $machinesCount = count($machines);

        if ($request->has('download')) {
            $pdf = PDF::loadView('user::machines.createPDF', compact('machines', 'machinesCount'))->setPaper('a4', 'portrait')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // return $pdf->download('pdfview.pdf');
            return $pdf->stream('pdfview.pdf');
        }

        return view('user::machines.createPDF', compact('machines', 'machinesCount'));
    }

    public function destroy($id)
    {
        Machines::find($id)->delete();

        return redirect()->route('machines.grid_view')->with('message', 'Machine deleted successfully');
    }
}
