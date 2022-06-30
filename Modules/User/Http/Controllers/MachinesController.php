<?php

namespace Modules\User\Http\Controllers;

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
    }

    public function createPDF(Request $request)
    {
        $machines = Machines::get();
        $machinesLength = count($machines); 

  
        if($request->has('download'))
        {
            $pdf = PDF::loadView('user::machines.createPDF',compact('machines','machinesLength'))->setPaper('a4', 'portrait')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            return $pdf->download('pdfview.pdf');
        }

        return view('user::machines.index',compact('machines'));
    }

    public function index()
    {
        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.id', 'machines.name','machines.codeQR', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
            ->paginate(10);

        // echo("<pre>");
        // print_r($machines);
        // echo("<\pre>");

        //exit;

        //dd($machines);

        return view('user::machines.index', compact('machines'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function grid_view()
    {
        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.id', 'machines.name','machines.codeQR', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
            ->get();

        // echo("<pre>");
        // print_r($machines);
        // echo("<\pre>");

        //exit;

        //dd($machines);

        return view('user::machines.index_grid', compact('machines'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $customers = DB::table('customers')->get();
        $status = ['Encendido', 'Apagado', 'Mantenimiento'];
        $machine = null;
        $codeQR = Str::random(8);
        return view('user::machines.create', compact('customers', 'status', 'machine', 'codeQR'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20|min:4',
            'status' => 'required|max:15|min:5',
            'customer_id' => 'required',
            'codeQR' => 'required|max:20|min:5|unique:machines,codeQR',
            'observation' => 'nullable|max:200|min:5',
        ]);

        $input = $request->all();
        $input['user_id'] = $request->user()->id;
        $input['name'] = strtoupper($request->input('name'));
        Machines::create($input);

        return redirect()->route('machines.index')->with('message', 'Machine created successfully.');
    }

    public function show($id)
    {
        $machine = DB::table('machines')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('customers.name AS customer_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation')
            ->where('machines.id', '=', $id)
            ->first();

        //to generate the qr code in the view from the obtained data
        $codeQR = $machine->codeQR;

        return view('user::machines.show', compact('machine', 'codeQR'));
    }

    public function edit($id)
    {
        $customers = Customers::all();
        $status = ['Encendido', 'Apagado', 'Mantenimiento'];

        $machine = DB::table('machines')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('customers.name AS customer_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation')
            ->where('machines.id', '=', $id)
            ->first();

        //to generate the qr code in the view from the obtained data
        $codeQR = $machine->codeQR;

        return view('user::machines.edit', compact('machine', 'status', 'customers','codeQR'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:20|min:4',
            'status' => 'required|max:15|min:5',
            'customer_id' => 'required',
            'codeQR' => 'required|max:20|min:5|unique:machines,codeQR,' . $id,
            'observation' => 'nullable|max:200|min:5',
        ]);

        $input = $request->all();
        $input['user_id'] = $request->user()->id;
        $input['name'] = strtoupper($request->input('name'));
        $machine = Machines::find($id);
        $machine->update($input);

        return redirect()->route('machines.index')->with('message', 'Machine updated successfully.');
    }

    public function destroy($id)
    {
        Machines::find($id)->delete();

        return redirect()->route('machines.index')->with('message', 'Machine deleted successfully');
    }
}
