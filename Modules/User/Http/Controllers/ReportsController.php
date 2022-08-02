<?php

namespace Modules\User\Http\Controllers;

use PDF;
use Modules\User\Entities\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Customers;
use Modules\User\Entities\Reports;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);

        $this->middleware('permission:report-list|report-create|report-edit|report-delete', ['only' => ['index']]);
        $this->middleware('permission:report-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:report-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:report-delete', ['only' => ['destroy']]);
    }

    public function users(Request $request)
    {
        $users = DB::table('users')->paginate(30);

        if ($request->has('download')) {
            $pdf = PDF::loadView('user::reports.createUsersPDF', compact('users'));
            return $pdf->stream();
            // return $pdf->download('pdfview.pdf');
        }

        return view('user::reports.users', compact('users'))->with('i', (request()->input('page', 1) - 1) * 30);
    }

    public function customers(Request $request)
    {
        $customers = DB::table('customers')->paginate(30);

        if ($request->has('download')) {
            $pdf = PDF::loadView('user::reports.createCustomersPDF', compact('customers'));
            return $pdf->stream();
            // return $pdf->download('pdfview.pdf');
        }

        return view('user::reports.customers', compact('customers'))->with('i', (request()->input('page', 1) - 1) * 30);
    }

    public function machines(Request $request)
    {
        $machines = DB::table('machines_api')
            ->leftjoin('customers', 'machines_api.customer_id', '=', 'customers.id')
            ->select('machines_api.id', 'machines_api.worker_name', 'machines_api.status', 'machines_api.shares_1m', 'machines_api.shares_5m', 'machines_api.shares_15m', 'customers.name AS customer_name')
            ->orderBy('id', 'DESC')
            ->paginate(30);
    
        if ($request->has('download')) {
            $machines = DB::table('machines_api')
                ->leftjoin('customers', 'machines_api.customer_id', '=', 'customers.id')
                ->select('machines_api.id', 'machines_api.worker_name', 'machines_api.status', 'machines_api.shares_1m', 'machines_api.shares_5m', 'machines_api.shares_15m', 'customers.name AS customer_name')
                ->orderBy('id', 'DESC')
                ->get();
    
            $pdf = PDF::loadView('user::reports.createMachinesPDF', compact('machines'));
            return $pdf->stream();
            // return $pdf->download('pdfview.pdf');
        }
    
        return view('user::reports.machines', compact('machines'))->with('i', (request()->input('page', 1) - 1) * 30);
    }

    public function schedules(Request $request)
    {
        $schedules = DB::table('schedules')
            ->join('users', 'schedules.user_id', '=', 'users.id')
            ->select('users.name', 'schedules.id', 'schedules.date', 'schedules.check_in_time', 'schedules.check_out_time', 'schedules.address_latitude_in', 'schedules.address_longitude_in', 'schedules.address_latitude_out', 'schedules.address_longitude_out')
            ->orderBy('schedules.created_at', 'DESC')
            ->Paginate(30);

        if ($request->has('download')) {
            $pdf = PDF::loadView('user::reports.createSchedulesPDF', compact('schedules'));
            return $pdf->stream();
            // return $pdf->download('pdfview.pdf');
        }

        return view('user::reports.schedules', compact('schedules'))->with('i', (request()->input('page', 1) - 1) * 30);
    }
}
