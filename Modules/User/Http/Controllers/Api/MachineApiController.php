<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Machines;

class MachineApiController extends Controller
{

    public function index()
    {
        $machines = Machines::all();
        return response()->json($machines);
    }

    public function edit($qrcode)
    {
        $machines = DB::table('machines')->where('codeQR','=', $qrcode)->first();
        return response()->json($machines);
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
        $machine = Machines::create($request->all());

        //return response
        return response()->json($machine);
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
        $machine = Machines::find($id);
        $machine->update($request->all());

        //return response
        return response()->json($request->id);
    }

    public function destroy(Machines $machine)
    {
        Machines::find($machine->id)->delete();
        return response()->json('deleted successfully');
    }
}
