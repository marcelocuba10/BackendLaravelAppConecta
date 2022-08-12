<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\Plans;

class PlansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);

        $this->middleware('permission:plan-sa-list|plan-sa-create|plan-sa-edit|plan-sa-delete', ['only' => ['index']]);
        $this->middleware('permission:plan-sa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:plan-sa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:plan-sa-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $plans = DB::table('plans')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin::plans.index', compact('plans'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin::plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[\p{L}\s-]+$/u|max:20|min:5|unique:plans,name',
            'price' => 'required|max:12|min:6',
        ]);

        //remove the separator thousands
        $input = $request->all();
        $input['price'] = str_replace('.', '', $input['price']);

        Plans::create($input);

        return redirect()->to('/admin/plans')->with('message', 'Plan created successfully.');
    }

    public function show($id)
    {
        $plan = DB::table('plans')
            ->where('plans.id', '=', $id)
            ->first();

        return view('admin::plans.show', compact('plan'));
    }

    public function edit($id)
    {
        $plan = DB::table('plans')
            ->where('plans.id', '=', $id)
            ->first();

        return view('admin::plans.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|regex:/^[\p{L}\s-]+$/u|max:20|min:5|unique:plans,name,'.$id,
            'price' => 'required|max:13|min:6',
        ]);

        //remove the separator thousands
        $input = $request->all();
        $input['price'] = str_replace('.', '', $input['price']);

        $plan = Plans::find($id);
        $plan->update($input);

        return redirect()->to('/admin/plans')->with('message', 'Plan updated successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            $plans = DB::table('plans')->paginate(10);
        } else {
            $plans = DB::table('plans')
                ->where('plans.name', 'LIKE', "%{$search}%")
                ->paginate();
        }

        return view('admin::plans.index', compact('plans', 'search'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        Plans::find($id)->delete();
        return redirect()->to('/admin/plans')->with('message', 'Plan deleted successfully');
    }
}
