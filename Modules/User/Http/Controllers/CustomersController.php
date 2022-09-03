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
            ->select('customers.id', 'customers.name', 'customers.pool', 'customers.phone', 'customers.total_machines', 'customers.address')
            ->orderBy('customers.created_at', 'DESC')
            ->paginate(10);

        return view('user::customers.index', compact('customers'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function grid_view()
    {
        $filter = null;
        $customers = DB::table('customers')->get();
        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
            ->orderBy('machines.created_at', 'DESC')
            ->get();

        return view('user::customers.show', compact('machines', 'customers', 'filter'));
    }

    public function create()
    {
        $customer = null;
        $pools_options = ['btc.com', 'antpool.com', 'binance.com', 'poolin.com'];

        return view('user::customers.create', compact('pools_options', 'customer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|min:5',
            'phone' => 'nullable|max:25|min:5',
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
                'customers.phone',
                'customers.address',
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
            ->where('machines.customer_id', '=', $id)
            ->select('users.name AS user_name', 'machines.total_power', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation')
            ->orderBy('machines.created_at', 'DESC')
            ->get();


        $machines_api = DB::table('machines_api')
            ->select('machines_api.id', 'machines_api.last10m', 'machines_api.worker')
            ->where('machines_api.customer_id', '=', $customer->id)
            ->orderBy('created_at', 'DESC')
            ->take($customer->total_machines)
            ->get();

        return view('user::customers.show', compact('customer', 'machines', 'machines_api'));
    }

    public function edit($id)
    {
        $customer = Customers::find($id);
        $pools_options = ['btc.com', 'antpool.com', 'binance.com', 'poolin.com'];

        return view('user::customers.edit', compact('customer', 'pools_options'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50|min:5',
            'phone' => 'nullable|max:25|min:5',
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
