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

    public function getMachineByQRcode($qrcode)
    {
        $machines = DB::table('machines')->where('codeQR','=', $qrcode)->first();
        return response()->json($machines);
    }

    public function update($qrcode, Request $request)
    {
        //validation
        $request->validate([
            'status' => 'required',
            'codeQR' => 'required',
            'user_id' => 'required',
            'observation' => 'nullable'
        ]);

        //update in DB
        $machine = DB::table('machines')->where('codeQR','=', $qrcode)->first();
        //$machine->update($request->all());

        DB::table('machines')
        ->where('codeQR','=', $qrcode)  
        ->update( [ 'status' => $request['status'], 'user_id' => $request['user_id'], 'observation' => $request['observation'] ]);

        //return response
        return response()->json('Machine updated successfully');
    }

    public function destroy(Machines $machine)
    {
        Machines::find($machine->id)->delete();
        return response()->json('deleted successfully');
    }
}
