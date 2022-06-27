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
            'check_out_time' => 'nullable|max:5|min:5',
            'date' => 'required|max:15|min:10',
        ]);

        Reports::create($request->all());

        return redirect()->route('reports.index')->with('message', 'Report created successfully.');
    }

    public function show($id)
    {
        $users = DB::table('users')->get();

        $report = DB::table('reports')
        ->leftjoin('users', 'reports.user_id', '=', 'users.id')
        ->select('users.name AS user_name', 'reports.id','reports.user_id', 'reports.date', 'reports.check_in_time', 'reports.check_out_time')
        ->where('reports.id', '=', $id)
        ->first();

        return view('user::reports.show',compact('report','users'));
    }

    public function edit($id)
    {
        $users = DB::table('users')->get();

        $report = DB::table('reports')
        ->leftjoin('users', 'reports.user_id', '=', 'users.id')
        ->select('users.name AS user_name', 'reports.id','reports.user_id', 'reports.date', 'reports.check_in_time', 'reports.check_out_time')
        ->where('reports.id', '=', $id)
        ->first();

        return view('user::reports.edit', compact('report','users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'check_in_time' => 'required|max:5|min:5',
            'check_out_time' => 'nullable|max:5|min:5',
            'date' => 'required|max:15|min:10',
        ]);

        $input = $request->all();
        $report = Reports::find($id);
        $report->update($input);

        return redirect()->route('reports.index')->with('message', 'Report updated successfully.');

    }

    public function destroy($id)
    {
        Reports::find($id)->delete();

        return redirect()->route('reports.index')->with('message','Report deleted successfully');
    }
}
