<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Customers;

class CustomersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);

        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index']]);
        $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $idRefCurrentUser = Auth::user()->idReference;
        $customers = DB::table('customers')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->select('customers.id', 'customers.name', 'customers.last_name', 'customers.pool', 'customers.phone', 'customers.total_machines', 'customers.address')
            ->orderBy('customers.created_at', 'DESC')
            ->paginate(10);

        return view('user::customers.index', compact('customers'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $customer = null;
        $pools_options = ['btc.com', 'antpool.com'];

        return view('user::customers.create', compact('pools_options', 'customer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|min:5',
            'last_name' => 'required|max:50|min:4',
            'phone' => 'nullable|max:25|min:5',
            'doc_id' => 'nullable|max:25|min:5',
            'email' => 'nullable|max:25|min:5|email:rfc,dns',
            'address' => 'nullable|max:255|min:5',
            'access_key' => 'nullable|max:25|min:15',
            'puid' => 'nullable|max:10|min:4',
            'total_machines' => 'required|integer|between:0,9999|min:0',
            'pool' => 'nullable|max:50|min:3',
            'userIdPool' => 'nullable|max:25|min:4',
            'apiKey' => 'nullable|max:40|min:4',
            'secretKey' => 'nullable|max:40|min:4',
        ]);

        $input = $request->all();

        /** link the customer with the admin user */
        $input['idReference'] = Auth::user()->idReference;
        Customers::create($input);

        return redirect()->to('/user/customers')->with('message', 'Customer created successfully.');
    }

    public function show($id)
    {
        $customer = DB::table('customers')
            ->where('customers.id', '=', $id)
            ->select(
                'customers.id',
                'customers.name',
                'customers.last_name',
                'customers.phone',
                'customers.address',
                'customers.email',
                'customers.doc_id',
                'customers.pool',
                'customers.total_machines',
                'customers.puid',
                'customers.access_key',
                'customers.userIdPool',
                'customers.apiKey',
                'customers.secretKey',
                'customers.shares_1m',
                'customers.shares_5m',
                'customers.shares_15m',
                'customers.shares_1h',
                'customers.shares_1d',
                'customers.shares_unit',

                'customers.workers_active',
                'customers.workers_inactive',
                'customers.workers_dead',
                'customers.workers_total',
                'customers.hsLast10m',
                'customers.hsLast1h',
                'customers.hsLast1d',
                'customers.totalAmount',
                'customers.unpaidAmount',
                'customers.yesterdayAmount',
                'customers.inactiveWorkerNum',
                'customers.activeWorkerNum',
                'customers.invalidWorkerNum',
                'customers.totalWorkerNum',
                'customers.updated_at'
            )
            ->first();

        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->where('machines.customer_id', '=', $customer->id)
            ->select('users.name AS user_name', 'machines.total_power', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation')
            ->orderBy('machines.created_at', 'DESC')
            ->get();

        $total_hash_local = DB::table('machines')
            ->where('machines.customer_id', '=', $customer->id)
            ->orderBy('created_at', 'DESC')
            ->sum('machines.total_power');

        $machines_api = DB::table('machines_api')
            ->select('machines_api.id', 'machines_api.last10m', 'machines_api.worker')
            ->where('machines_api.customer_id', '=', $customer->id)
            ->orderBy('created_at', 'DESC')
            ->take($customer->total_machines)
            ->get();

        /** Count total hashrate from api antpool */
        if ($customer->pool == "antpool.com") {
            $total_hash_pool = DB::table('machines_api')
                ->where('machines_api.customer_id', '=', $customer->id)
                ->orderBy('created_at', 'DESC')
                ->groupBy('created_at')
                ->take(1)
                ->sum('machines_api.last10m');

            $total_hash_pool_graph = DB::table('machines_api')
                ->where('machines_api.customer_id', '=', $customer->id)
                ->whereDate('created_at', 'LIKE', date('Y-m-d').'%')
                ->selectRaw("REPLACE(FORMAT(SUM(last10m), 2), ',', '') as totalhash")
                ->orderBy('created_at', 'DESC')
                ->groupBy('created_at')
                ->pluck('totalhash');
        }

        /** Count total hashrate from api antpool */
        if ($customer->pool == "btc.com") {
            $total_hash_pool = null;
            $total_hash_pool_graph = null;
        }

        return view('user::customers.show', compact('total_hash_pool_graph', 'customer', 'machines', 'machines_api', 'total_hash_pool', 'total_hash_local'));
    }

    public function edit($id)
    {
        $customer = Customers::find($id);
        $pools_options = ['btc.com', 'antpool.com'];

        return view('user::customers.edit', compact('customer', 'pools_options'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50|min:5',
            'last_name' => 'nullable|max:50|min:4',
            'phone' => 'nullable|max:25|min:5',
            'doc_id' => 'nullable|max:25|min:5',
            'email' => 'nullable|max:25|min:5|email:rfc,dns',
            'address' => 'nullable|max:255|min:5',
            'access_key' => 'nullable|max:25|min:15',
            'puid' => 'nullable|max:10|min:4',
            'total_machines' => 'required|integer|between:0,9999|min:0',
            'pool' => 'nullable|max:50|min:3',
            'userIdPool' => 'nullable|max:25|min:4',
            'apiKey' => 'nullable|max:40|min:4',
            'secretKey' => 'nullable|max:40|min:4',
        ]);

        $customer = Customers::find($id);
        $customer->update($request->all());

        return redirect()->to('/user/customers')->with('message', 'Customer updated successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $idRefCurrentUser = Auth::user()->idReference;

        if ($search == '') {
            $customers = DB::table('customers')
                ->select('customers.id', 'customers.name', 'customers.phone', 'customers.pool', 'customers.total_machines')
                ->where('customers.idReference', '=', $idRefCurrentUser)
                ->orderBy('customers.created_at', 'DESC')
                ->paginate(10);
        } else {
            $customers = DB::table('customers')
                ->select('customers.id', 'customers.name', 'customers.phone', 'customers.pool', 'customers.total_machines')
                ->where('customers.name', 'LIKE', "%{$search}%")
                ->where('customers.idReference', '=', $idRefCurrentUser)
                ->orderBy('customers.created_at', 'DESC')
                ->paginate();
        }

        return view('user::customers.index', compact('customers', 'search'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        Customers::find($id)->delete();
        return redirect()->to('/user/customers')->with('message', 'Customer deleted successfully');
    }
}
