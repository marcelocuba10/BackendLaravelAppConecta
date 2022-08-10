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
        $plans = DB::table('plans')->paginate(10);
        return view('admin::plans.index', compact('plans'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin::plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20|min:5',
            'price' => 'required',
        ]);

        Plans::create($request->all());

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
        //date validation, not less than 1980 and not greater than the current year
        $initialDate = '1980-01-01';
        $currentDate = (date('Y') + 1) . '-01-01'; //2023-01-01

        $request->validate([
            'title' => 'required|max:50|min:5',
            'date' => 'required|date_format:Y-m-d|after_or_equal:today|before:' . $currentDate,
            'subject' => 'required|max:150|min:5',
        ]);

        $plan = Plans::find($id);
        $plan->update($request->all());

        return redirect()->to('/admin/plans')->with('message', 'Plan updated successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            $plans = DB::table('plans')->paginate(10);
        } else {
            $plans = DB::table('plans')
                ->where('plans.title', 'LIKE', "%{$search}%")
                ->orWhere('plans.subject', 'LIKE', "%{$search}%")
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
