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
        ->select('users.*','schedules.*')
        ->Paginate(10);

        return view('user::schedules.index', compact('schedules'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $users = DB::table('users')->get();
        $schedule = null;

        return view('user::schedules.create',compact('users','schedule'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'check_in_time' => 'required|max:5|min:5',
            'check_out_time' => 'nullable|max:5|min:5',
            'date' => 'required|max:15|min:10',
        ]);

        Schedules::create($request->all());

        return redirect()->route('schedules.index')->with('message', 'Schedule created successfully.');
    }

    public function show($id)
    {
        $schedule = DB::table('schedules')
        ->leftjoin('users', 'schedules.user_id', '=', 'users.id')
        ->select('users.name AS user_name', 'schedules.id','schedules.user_id', 'schedules.date', 'schedules.check_in_time', 'schedules.check_out_time')
        ->where('schedules.id', '=', $id)
        ->first();

        return view('user::schedules.show',compact('schedule','users'));
    }

    public function edit($id)
    {
        //if create new schedule, send all user list
        $users = DB::table('users')->get();

        //dd($id);
        $schedule = DB::table('schedules')
        ->leftjoin('users', 'schedules.user_id', '=', 'users.id')
        ->select('users.name AS user_name', 'schedules.id','schedules.user_id', 'schedules.date', 'schedules.check_in_time', 'schedules.check_out_time')
        ->where('schedules.id', '=', $id)
        ->first();

        //dd($schedule);
        return view('user::schedules.edit', compact('schedule','users'));
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
        $schedule = Schedules::find($id);
        $schedule->update($input);

        return redirect()->route('schedules.index')->with('message', 'Schedule updated successfully.');

    }

    public function destroy($id)
    {
        Schedules::find($id)->delete();

        return redirect()->route('schedules.index')->with('message','Schedule deleted successfully');
    }
}
