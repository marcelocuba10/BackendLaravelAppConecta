<?php

namespace Modules\User\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Reports;

class ReportApiController extends Controller
{
    public function index()
    {
        $reports= Reports::all();
        return response()->json($reports);
    }

    public function getReportsByUser($id)
    {
        //$user = User::find($id);

        $reports = Reports::where('userId', '=', $id)->get();

        return response()->json($reports);
    }

    public function edit($id)
    {

        $reports = Reports::find($id);
        
        return response()->json($reports);
    }

    public function store(Request $request){
        //validation
        $request->validate([
            'userId'=> 'required',
            'date'=>'required',
            'check_in_time'=>'required',
            'check_out_time'=>'required',
        ]);

        //save to DB
        $report = Reports::create([
            'userId'=>$request->userId,
            'date'=>$request->date,
            'check_in_time'=>$request->check_in_time,
            'check_out_time'=>$request->check_out_time,
        ]);

        //return response
        return response()->json($report);
        
    }

    public function update(Request $request , Reports $report){
        //validation
        $request->validate([
            'userId'=> 'required',
            'date'=>'required',
            'check_in_time'=>'required',
            'check_out_time'=>'required',
        ]);

        //update in DB
        $report->update([
            'userId'=>$request->userId,
            'date'=>$request->date,
            'check_in_time'=>$request->check_in_time,
            'check_out_time'=>$request->check_out_time,
        ]);

        //return response
        return response()->json($report);
        
    }

    public function destroy(Reports $report){
        Reports::find($report->id)->delete();
        return response()->json('deleted successfully');
    }
}
