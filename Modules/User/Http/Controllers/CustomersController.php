<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Customers;

class CustomersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);
    }

    public function index()
    {
        $customers = DB::table('customers')->paginate(10);
        return view('user::customers.index', compact('customers'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('user::customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|min:5',
            'phone' => 'required|max:25|min:5',
            'address' => 'required|max:255|min:5',
            'access_key' => 'nullable|max:250|min:5',
            'puid' => 'nullable|max:100|min:5',
        ]);

        Customers::create($request->all());
        return redirect()->route('customers.index')->with('message', 'Customer created successfully.');
    }

    public function show($id)
    {
        $customer = Customers::find($id);
        return view('user::customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customers::find($id);
        return view('user::customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50|min:5',
            'phone' => 'required|max:25|min:5',
            'address' => 'required|max:255|min:5',
            'access_key' => 'nullable|max:250|min:5',
            'puid' => 'nullable|max:100|min:5',
        ]);

        $customer = Customers::find($id);
        $customer->update($request->all());

        return redirect()->route('customers.index')->with('message', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        Customers::find($id)->delete();
        return redirect()->route('customers.index')->with('message', 'Customer deleted successfully');
    }
}
