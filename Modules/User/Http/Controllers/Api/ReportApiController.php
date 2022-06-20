<?php

namespace Modules\User\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Reports;

class ReportApiController extends Controller
{
    public function index()
    {
        $reports = DB::table('reports')->orderBy('id', 'desc');
        //$reports= Reports::all()->latest();
        return response()->json($reports);
    }

    public function getReportsByUser($id)
    {
        //$user = User::find($id);
        $reports = Reports::where('user_id', '=', $id)->get();

        return response()->json($reports);
    }

    public function checkReport($id)
    {
        //$user = User::find($id);
        //$report = Reports::where('user_id', '=', $id)->get();

        $now = date('d/m/Y');
        $date = str_replace('', '/', $now);
        $result = Reports::where('user_id', '=', $id)
            ->where('date', '=', $now)
            ->get();

        return response()->json($date);
    }

    public function edit($id)
    {

        $reports = Reports::find($id);
        return response()->json($reports);
    }

    public function store(Request $request)
    {
        //validation
        $request->validate([
            'user_id' => 'required',
            'date' => 'required',
            'check_in_time' => 'required',
            'check_out_time' => 'required',
        ]);

        //save to DB
        $report = Reports::create([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'check_in_time' => $request->check_in_time,
            'check_out_time' => $request->check_out_time,
        ]);

        //return response
        return response()->json($report);
    }

    public function update($id, Request $request)
    {
        //validation
        $request->validate([
            'user_id' => 'required',
            'date' => 'required',
            'check_out_time' => 'required',
        ]);

        $report = Reports::find($id);
        $report->update($request->all());

        // //update in DB
        // $report->update([
        //     'user_id'=>$request->user_id,
        //     'date'=>$request->date,
        //     'check_out_time'=>$request->check_out_time,
        // ]);

        //return response
        return response()->json($request->id);
    }

    public function destroy(Reports $report)
    {
        Reports::find($report->id)->delete();
        return response()->json('deleted successfully');
    }
}
