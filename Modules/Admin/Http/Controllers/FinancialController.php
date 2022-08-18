<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\Financial;
use Modules\User\Entities\User;

class FinancialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);

        $this->middleware('permission:financial-sa-list|financial-sa-create|financial-sa-edit|financial-sa-delete', ['only' => ['index']]);
        $this->middleware('permission:financial-sa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:financial-sa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:financial-sa-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $finances = DB::table('financials')
            ->leftjoin('users', 'financials.customer_id', '=', 'users.idReference')
            ->leftjoin('plans', 'financials.plan_id', '=', 'plans.id')
            ->select('plans.name AS plan_name', 'plans.price', 'users.name AS customer_name', 'users.last_name', 'users.email', 'users.idReference', 'financials.exp_date_plan', 'financials.id')
            ->orderBy('financials.created_at', 'DESC')
            ->paginate(10);

        return view('admin::financial.index', compact('finances'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function show($id)
    {
        $finance = DB::table('financials')
            ->leftjoin('users', 'financials.customer_id', '=', 'users.idReference')
            ->leftjoin('plans', 'financials.plan_id', '=', 'plans.id')
            ->select('plans.name AS plan_name', 'plans.price', 'users.name AS customer_name', 'users.last_name', 'users.email', 'users.idReference', 'financials.exp_date_plan', 'financials.id')
            ->orderBy('financials.created_at', 'DESC')
            ->first();

        return view('admin::financial.show', compact('finance'));
    }

    public function edit($id)
    {
        /** get current user role */
        $arrayCurrentUserRole = Auth::user()->roles->pluck('name');
        $currentUserRole = $arrayCurrentUserRole[0];

        $days = [1, 5, 10, 15, 20, 25, 30];

        $plans = DB::table('plans')->get();

        $finance = DB::table('financials')
            ->leftjoin('users', 'financials.customer_id', '=', 'users.idReference')
            ->leftjoin('plans', 'financials.plan_id', '=', 'plans.id')
            ->where('financials.id', '=', $id)
            ->select('plans.name AS plan_name', 'plans.price', 'users.name AS customer_name', 'users.last_name', 'users.email', 'users.idReference', 'financials.exp_date_plan', 'financials.id','financials.plan_id')
            ->orderBy('financials.created_at', 'DESC')
            ->first();

        $customerPlan = $finance->plan_id;

        return view('admin::financial.edit', compact('finance', 'days', 'plans', 'currentUserRole','customerPlan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'plan_id' => 'required|integer',
            'exp_date_plan' => 'required|integer|between:1,30',
        ]);

        $input = $request->all();

        $finance = Financial::find($id);
        $finance->update($input);

        DB::table('users')
            ->where('idReference', '=', $finance->customer_id)
            ->update(
                [
                    'plan_id' => $input['plan_id'],
                    'exp_date_plan' => $input['exp_date_plan'],
                    'updated_at' => Carbon::now(),
                ]
            );

        return redirect()->to('/admin/financial')->with('message', 'Registro actualizado correctamente');
    }
}
