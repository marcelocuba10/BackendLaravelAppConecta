<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Customers;
use Modules\User\Entities\Machines;

class MachinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);
    }

    public function index()
    {
        $machines = DB::table('machines')
            ->join('users', 'machines.user_id', '=', 'users.id')
            ->join('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.*', 'customers.name AS customer_name')
            ->Paginate(10);

        //dd($machines);   

        return view('user::machines.index', compact('machines'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $customers = Customers::all();
        $status = ['Encendido', 'Apagado', 'Mantenimiento'];
        return view('user::machines.create', compact('customers', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20|min:5',
            'status' => 'required|max:15|min:5',
            'customer_id' => 'required',
            'observation' => 'nullable|max:200|min:5',
        ]);

        $input = $request->all();
        $input['user_id'] = 1;

        Machines::create($input);

        return redirect()->route('machines.index')->with('message', 'Machine created successfully.');
    }

    public function show($id)
    {
        //$machine = Machines::find($id);
        $machine = DB::table('machines')
                    ->select('machines.name')            
                    ->get();

        //dd($machine);
        return view('user::machines.show', compact('machine'));
    }

    public function edit($id)
    {
        $machine = DB::table('machines')
        ->join('users', 'machines.user_id', '=', 'users.id')
        ->join('customers', 'machines.customer_id', '=', 'customers.id')
        ->select('users.last_name', 'machines.*', 'customers.name')
        ->where('machines.id', '=', $id)
        ->get();

        return view('user::machines.edit', compact('machine'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:20|min:5',
            'status' => 'required|max:15|min:5',
            'customer_id' => 'required',
            'observation' => 'nullable|max:200|min:5',
        ]);

        $machine = Machines::find($id);
        $input['user_id'] = $request->user()->id;

        $machine->update($request->all());

        return redirect()->route('machines.index')->with('message', 'Machine updated successfully.');
    }

    public function destroy($id)
    {
        Machines::find($id)->delete();

        return redirect()->route('machines.index')->with('message', 'Machine deleted successfully');
    }
}
