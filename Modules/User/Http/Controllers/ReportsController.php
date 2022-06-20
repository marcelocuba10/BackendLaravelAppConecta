<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Reports;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);
    }

    public function index()
    {
        $reports = DB::table('reports')->orderBy('id','desc')->paginate(10);
        //$reports = Reports::latest()->paginate(10);
        return view('user::reports.index', compact('reports'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('user::reports.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $report=Reports::find($id);
        return view('user::reports.show',compact('report'));
    }

    public function edit($id)
    {
        $report = Reports::find($id);

        $user=$report->user;

        dd($user);

        return view('user::reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = Reports::find($id);

    }

    public function destroy($id)
    {
        
    }
}
