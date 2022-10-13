<?php

namespace Modules\User\Http\Controllers;

use App\Exports\MachinesExport;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Imports\MachinesImport;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{

    public function index()
    {
        return view('user::importCsv.index');
    }

    public function importcsv(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx'
        ]);

        $import = new MachinesImport;
        $file = $request->file('file');

        Excel::import($import, $file);

        return redirect()->to('/user/machines/import-csv')->with('message', 'El archivo ha sido importado correctamente');
    }

    public function exportcsv()
    {
        $idRefCurrentUser = Auth::user()->idReference;

        $date = new DateTime();
        $date->modify('-3 minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');

        $machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select(
                'machines.id',
                'machines.name',
                'machines.total_power',
                'machines.mining_power',
                'customers.name AS customer_name',
                'users.name AS user_name',
            )
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->orderBy('id', 'DESC')
            ->get();

        $machines_api = DB::table('machines_api')
            ->leftjoin('customers', 'machines_api.customer_id', '=', 'customers.id')
            ->select(
                'machines_api.id',
                'machines_api.last10m',
                'machines_api.worker',
                'machines_api.created_at'
            )
            ->where('machines_api.created_at', '>=', $formatted_date)
            ->orderBy('machines_api.created_at', 'DESC')
            ->get();

        foreach ($machines as $machine) {
            foreach ($machines_api as $machines_api_item) {
                if (strtolower($machines_api_item->worker) === strtolower($machine->name)) {
                    $machineStatusTitle = '';

                    $percent = $machine->total_power * 0.10;
                    $percentFourty = $machine->total_power * 0.40;
                    $percentFifty = $machine->total_power * 0.50;
                    $total_power_percent_ten = $machine->total_power - $percent;
                    $total_power_percent_fourty = $machine->total_power - $percentFourty;
                    $total_power_percent_fifty = $machine->total_power - $percentFifty;

                    if ($machines_api_item->last10m == 0) {
                        $machineStatusTitle = 'Inactive';
                    } elseif ($machines_api_item->last10m >= $machine->total_power || $machines_api_item->last10m >= $total_power_percent_ten) {
                        $machineStatusTitle = 'Active';
                    } elseif ($machines_api_item->last10m <= $total_power_percent_ten || $machines_api_item->last10m <= $total_power_percent_fourty && $machines_api_item->last10m > 0 && $machines_api_item->last10m >= $total_power_percent_fifty) {
                        $machineStatusTitle = 'Requires Attention';
                    } else {
                        $machineStatusTitle = 'Inactive';
                    }

                    $machinesArray[] = array(
                        'name' => $machine->name,
                        'status' => $machineStatusTitle,
                        'mining_power' => $machine->mining_power,
                        'total_power' => $machine->total_power,
                        'pool_hashrate' => $machines_api_item->last10m,
                        'created_at' => $machines_api_item->created_at,
                        'customer_name' => $machine->customer_name,
                        'user_name' => $machine->user_name,
                    );
                }
            }
        }

        $date = Carbon::now();
        return Excel::download(new MachinesExport($machinesArray), 'machines-' . $date . '.xlsx');
    }
}
