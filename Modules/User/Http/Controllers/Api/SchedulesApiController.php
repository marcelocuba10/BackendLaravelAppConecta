<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Schedules;

class SchedulesApiController extends Controller
{
    public function index()
    {
        $schedules = Schedules::all();
        return response()->json($schedules);
    }

    public function getSchedulesByUser($id)
    {
        $schedules = Schedules::where('user_id', '=', $id)->orderBy('id', 'desc')->get();

        return response()->json($schedules);
    }

    public function checkSchedule($id)
    {
        /** verify if there are any schedules in the day */
        $now = date('d-m-Y');
        $result = Schedules::where('user_id', '=', $id)
            ->where('date', '=', $now)
            ->get();

        return response()->json($result);
    }

    public function edit($id)
    {
        $schedules = Schedules::find($id);
        return response()->json($schedules);
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
        $schedule = Schedules::create($request->all());

        //return response
        return response()->json($schedule);
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
        $schedule = Schedules::find($id);
        $schedule->update($request->all());

        //return response
        return response()->json($request->id);
    }

    public function destroy(Schedules $schedule)
    {
        Schedules::find($schedule->id)->delete();
        return response()->json('Schedule deleted successfully');
    }
}
