<?php

namespace Modules\User\Http\Controllers;

use Modules\User\Entities\User;
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
        //$reports = DB::table('reports')->orderBy('id','desc')->paginate(10);

        $reports = DB::table('reports')
        ->join('users', 'reports.user_id', '=', 'users.id')
        ->select('users.*','reports.*')
        ->Paginate(10);

        return view('user::reports.index', compact('reports'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $users = DB::table('users')->get();
        $report = null;

        return view('user::reports.create',compact('users','report'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'check_in_time' => 'required|max:5|min:5',
            'check_out_time' => 'required|max:5|min:5',
            'date' => 'required|max:15|min:10',
        ]);

        Reports::create($request->all());

        return redirect()->route('reports.index')->with('message', 'Report created successfully.');
    }

    public function show($id)
    {
        $report=DB::table('users')
        ->join('reports', function ($join) {
            $join->on('users.id', '=', 'reports.user_id')
                 ->where('users.id', '=',1);
        })
        ->get();

        //dd($report);

        $users = DB::table('users')->get();

        return view('user::reports.show',compact('report','users'));
    }

    public function edit($id)
    {
        $report = Reports::where('reports.id','=', $id)
            ->join('users', 'reports.user_id', '=', 'users.id')
            ->select('reports.*','users.name')->get();

        //dd($report);
        $users = DB::table('users')->get();

        return view('user::reports.edit', compact('report','users'));
    }

    public function update(Request $request, $id)
    {
        $report = Reports::find($id);

    }

    public function destroy($id)
    {
        Reports::find($id)->delete();

        return redirect()->route('reports.index')->with('message','Report deleted successfully');
    }
}
