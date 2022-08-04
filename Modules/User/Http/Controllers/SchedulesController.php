<?php

namespace Modules\User\Http\Controllers;

use Modules\User\Entities\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Schedules;

class SchedulesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);

        $this->middleware('permission:schedule-list|schedule-create|schedule-edit|schedule-delete', ['only' => ['index']]);
        $this->middleware('permission:schedule-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:schedule-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:schedule-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $schedules = DB::table('schedules')
            ->join('users', 'schedules.user_id', '=', 'users.id')
            ->select('users.name', 'users.last_name', 'schedules.id', 'schedules.date', 'schedules.check_in_time', 'schedules.check_out_time', 'schedules.address_latitude_in', 'schedules.address_longitude_in', 'schedules.address_latitude_out', 'schedules.address_longitude_out')
            ->orderBy('schedules.created_at', 'DESC')
            ->Paginate(10);

        return view('user::schedules.index', compact('schedules'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $users = DB::table('users')->get();
        $schedule = null;

        return view('user::schedules.create', compact('users', 'schedule'));
    }

    public function store(Request $request)
    {
        /** date validation, not less than 1980 and not greater than the current year **/
        $initialDate = '1980-01-01';
        $currentDate = (date('Y') + 1) . '-01-01'; //2023-01-01

        $request->validate([
            'user_id' => 'required',
            'check_in_time' => 'required|max:5|min:5',
            'check_out_time' => 'nullable|max:5|min:5',
            'date' => 'required|date_format:Y-m-d|after_or_equal:' . $initialDate . '|before:' . $currentDate,
        ]);

        Schedules::create($request->all());

        return redirect()->route('schedules.index')->with('message', 'Schedule created successfully.');
    }

    public function show($id)
    {
        $schedule = DB::table('schedules')
            ->leftjoin('users', 'schedules.user_id', '=', 'users.id')
            ->select('users.name AS user_name', 'schedules.id', 'schedules.user_id', 'schedules.date', 'schedules.check_in_time', 'schedules.check_out_time')
            ->where('schedules.id', '=', $id)
            ->first();

        return view('user::schedules.show', compact('schedule'));
    }

    public function edit($id)
    {
        //if create new schedule, send all user list
        $users = DB::table('users')->get();

        $schedule = DB::table('schedules')
            ->leftjoin('users', 'schedules.user_id', '=', 'users.id')
            ->select('users.name AS user_name', 'schedules.id', 'schedules.user_id', 'schedules.date', 'schedules.check_in_time', 'schedules.check_out_time')
            ->where('schedules.id', '=', $id)
            ->first();

        return view('user::schedules.edit', compact('schedule', 'users'));
    }

    public function update(Request $request, $id)
    {
        /** date validation, not less than 1980 and not greater than the current year **/
        $initialDate = '1980-01-01';
        $currentDate = (date('Y') + 1) . '-01-01'; //2023-01-01

        $request->validate([
            'user_id' => 'required',
            'check_in_time' => 'required|max:5|min:5',
            'check_out_time' => 'nullable|max:5|min:5',
            'date' => 'required|date_format:Y-m-d|after_or_equal:' . $initialDate . '|before:' . $currentDate,
        ]);

        $input = $request->all();
        $schedule = Schedules::find($id);
        $schedule->update($input);

        return redirect()->route('schedules.index')->with('message', 'Schedule updated successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            $schedules = DB::table('schedules')
                ->leftjoin('users', 'schedules.user_id', '=', 'users.id')
                ->select('users.name', 'users.last_name', 'schedules.id', 'schedules.date', 'schedules.check_in_time', 'schedules.check_out_time', 'schedules.address_latitude_in', 'schedules.address_longitude_in', 'schedules.address_latitude_out', 'schedules.address_longitude_out')
                ->paginate(10);
        } else {
            $schedules = DB::table('schedules')
                ->leftjoin('users', 'schedules.user_id', '=', 'users.id')
                ->select('users.name', 'users.last_name', 'schedules.id', 'schedules.date', 'schedules.check_in_time', 'schedules.check_out_time', 'schedules.address_latitude_in', 'schedules.address_longitude_in', 'schedules.address_latitude_out', 'schedules.address_longitude_out')
                ->where('users.name', 'LIKE', "%{$search}%")
                ->paginate();
        }

        return view('user::schedules.index', compact('schedules', 'search'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        Schedules::find($id)->delete();
        return redirect()->route('schedules.index')->with('message', 'Schedule deleted successfully');
    }
}
