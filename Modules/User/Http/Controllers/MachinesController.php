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

    public function search_list(Request $request)
    {
        $filter = $request->input('filter');

        if ($filter == 'Todos' || $filter == null) {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
                ->paginate(15);
        } else {
            $machines = DB::table('machines')
                ->leftjoin('users', 'machines.user_id', '=', 'users.id')
                ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
                ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
                ->where('customers.name', 'LIKE', "%{$filter}%")
                ->orWhere('machines.status', 'LIKE', "{$filter}")
                ->paginate(15);
        }

        return view('user::machines.index', compact('machines', 'filter'))->with('i', (request()->input('page', 1) - 1) * 15);
    }

    public function search_gridview(Request $request)
    {
        $filter = null;
        $search = $request->input('search');

        $customers = DB::table('customers')
            ->select('customers.id', 'customers.name', 'customers.access_key', 'customers.puid')
            ->where('customers.name', 'LIKE', "%{$search}%")
            ->orWhere('customers.puid', 'LIKE', "%{$search}%")
            ->get();

        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
            ->get();

        return view('user::machines.index_grid', compact('search', 'customers', 'machines', 'filter'));
    }

    public function filter_gridview(Request $request)
    {
        $filter = $request->input('filter');
        $customers = DB::table('customers')->get();

        if ($filter == "Todos") {
            $filter = null;
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
                ->where('machines.status', 'LIKE', "{$filter}")
                ->get();
        }

        return view('user::machines.index_grid', compact('filter', 'customers', 'machines'));
    }

    public function search_gridview_api(Request $request)
    {
        $filter = null;
        $status="all";
        $search = $request->input('search');

        $customers = DB::table('customers')
            ->select('customers.id', 'customers.name', 'customers.access_key', 'customers.puid')
            ->where('customers.name', 'LIKE', "%{$search}%")
            ->orWhere('customers.puid', 'LIKE', "%{$search}%")
            ->get();

        if ($request->ajax()) {
            $view = view('user::machines._partials.data', compact('customers', 'status'))->render();
            return response()->json(['html' => $view]);
        }

        return view('user::machines.index_grid_api', compact('search', 'customers','filter','status'));
    }

    public function filter_gridview_api(Request $request)
    {
        $filter = $request->input('filter');

        if (!$filter || $filter == 'Todos') {
            $customers = DB::table('customers')->paginate(1);
            return redirect()->route('machines.grid_view', compact('customers', 'status'));
        }

        if ($filter == "active") {
            $status = "active";
            $customers = DB::table('customers')->paginate(1);
        } elseif ($filter == "inactive") {
            $status = "inactive";
            $customers = DB::table('customers')->paginate(1);
        }

        if ($request->ajax()) {
            $view = view('user::machines._partials.data', compact('customers', 'status'))->render();
            return response()->json(['html' => $view]);
        }

        return view('user::machines.index_grid_api', compact('filter', 'customers', 'status'));
    }

    public function grid_view_api(Request $request)
    {
        $filter = null;
        $status = $request->input('status');

        if ($status == "active" || $status == "inactive") {
            $customers = DB::table('customers')->paginate(1);
        } else {
            $customers = DB::table('customers')->paginate(1);
        }

        if ($request->ajax()) {
            $view = view('user::machines._partials.data', compact('customers', 'status'))->render();
            return response()->json(['html' => $view]);
        }

        return view('user::machines.index_grid_api', compact('filter', 'customers', 'status'));
    }

    public function grid_view()
    {
        $filter = null;
        $customers = DB::table('customers')->get();
        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
            ->get();

        return view('user::machines.index_grid', compact('machines', 'customers', 'filter'));
    }

    public function index()
    {
        $filter = null;
        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
            ->orderBy('id', 'DESC')
            ->paginate(15);

        return view('user::machines.index', compact('machines', 'filter'))->with('i', (request()->input('page', 1) - 1) * 15);
    }

    public function create()
    {
        $customers = DB::table('customers')->get();
        $status = ['ACTIVE', 'Apagado', 'Mantenimiento', 'Requiere Atención', 'Error', 'INACTIVE'];
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
        $status = ['ACTIVE', 'Apagado', 'Mantenimiento', 'Requiere Atención', 'Error', 'INACTIVE'];

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

    public function createPDF(Request $request)
    {
        $machines = DB::table('machines')->get();
        //dd($machines);
        $machinesCount = count($machines);
        //$machinesCount = 10;

        if ($request->has('download')) {
            $pdf = PDF::loadView('user::machines.createPDF', compact('machines', 'machinesCount'))->setPaper('a4', 'portrait')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // return $pdf->download('pdfview.pdf');
            return $pdf->stream('pdfview.pdf');
        }

        return view('user::machines.index', compact('machines'));
    }

    public function destroy($id)
    {
        Machines::find($id)->delete();

        return redirect()->route('machines.index')->with('message', 'Machine deleted successfully');
    }
}
