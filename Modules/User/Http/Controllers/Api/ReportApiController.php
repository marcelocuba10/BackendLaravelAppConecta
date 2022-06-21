<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Reports;

class ReportApiController extends Controller
{
    public function index()
    {
        $reports = Reports::all();
        return response()->json($reports);
    }

    public function getReportsByUser($id)
    {
        $reports = Reports::where('user_id', '=', $id)->orderBy('id', 'desc')->get();

        return response()->json($reports);
    }

    public function checkReport($id)
    {
        /** verify if there are any reports in the day */
        $now = date('d-m-Y');
        $result = Reports::where('user_id', '=', $id)
            ->where('date', '=', $now)
            ->get();

        return response()->json($result);
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
            'address_latitude_in' => 'required',
            'address_longitude_in' => 'required'
        ]);

        //save to DB
        $report = Reports::create($request->all());

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
            'address_latitude_out' => 'required',
            'address_longitude_out' => 'required'
        ]);

        //update in DB
        $report = Reports::find($id);
        $report->update($request->all());

        //return response
        return response()->json($request->id);
    }

    public function destroy(Reports $report)
    {
        Reports::find($report->id)->delete();
        return response()->json('deleted successfully');
    }
}
