<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\Customers;

class CustomersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);

        $this->middleware('permission:customer-sa-list|customer-sa-create|customer-sa-edit|customer-sa-delete', ['only' => ['index']]);
        $this->middleware('permission:customer-sa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-sa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer-sa-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $customers = DB::table('customers')->paginate(10);
        return view('admin::customers.index', compact('customers'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin::customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|min:5',
            'phone' => 'nullable|max:25|min:5',
            'address' => 'nullable|max:255|min:5',
            'access_key' => 'nullable|max:15|min:15',
            'puid' => 'nullable|max:6|min:6',
            'total_machines' => 'required|integer|between:0,9999|min:0',
        ]);

        Customers::create($request->all());
        return redirect()->to('/admin/customers')->with('message', 'Customer created successfully.');
    }

    public function show($id)
    {
        $customer = Customers::find($id);
        return view('admin::customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customers::find($id);
        return view('admin::customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50|min:5',
            'phone' => 'nullable|max:25|min:5',
            'address' => 'nullable|max:255|min:5',
            'access_key' => 'nullable|max:15|min:15',
            'puid' => 'nullable|max:6|min:6',
            'total_machines' => 'required|integer|between:0,9999|min:0',
        ]);

        $customer = Customers::find($id);
        $customer->update($request->all());

        return redirect()->to('/admin/customers')->with('message', 'Customer updated successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            $customers = DB::table('customers')->paginate(30);
        } else {
            $customers = DB::table('customers')->where('customers.name', 'LIKE', "%{$search}%")->paginate();
        }

        return view('admin::customers.index', compact('customers', 'search'))->with('i', (request()->input('page', 1) - 1) * 2);
    }

    public function destroy($id)
    {
        Customers::find($id)->delete();
        return redirect()->to('/admin/customers')->with('message', 'Customer deleted successfully');
    }
}
