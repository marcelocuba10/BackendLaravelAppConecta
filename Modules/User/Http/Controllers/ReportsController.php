<?php

namespace Modules\User\Http\Controllers;

use Modules\User\Entities\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
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
        $machines = DB::table('machines')->get();
        //dd($machines);
        $machinesCount = count($machines);
        //$machinesCount = 10;

        if ($request->has('download')) {
            $pdf = PDF::loadView('user::machines.createPDF', compact('machines', 'machinesCount'))->setPaper('a4', 'portrait')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // return $pdf->download('pdfview.pdf');
            return $pdf->stream('pdfview.pdf');
        }

        return view('user::machines.createPDF', compact('machines'));
    }

    public function customers(Request $request)
    {
        $customers = DB::table('customers')->paginate(10);
        return view('user::reports.customers', compact('customers'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function machines(Request $request)
    {
        $machines = DB::table('machines')->get();
        //dd($machines);
        $machinesCount = count($machines);
        //$machinesCount = 10;

        if ($request->has('download')) {
            $pdf = PDF::loadView('user::machines.createPDF', compact('machines', 'machinesCount'))->setPaper('a4', 'portrait')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // return $pdf->download('pdfview.pdf');
            return $pdf->stream('pdfview.pdf');
        }

        return view('user::machines.createPDF', compact('machines'));
    }

    public function schedules(Request $request)
    {
        $machines = DB::table('machines')->get();
        //dd($machines);
        $machinesCount = count($machines);
        //$machinesCount = 10;

        if ($request->has('download')) {
            $pdf = PDF::loadView('user::machines.createPDF', compact('machines', 'machinesCount'))->setPaper('a4', 'portrait')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // return $pdf->download('pdfview.pdf');
            return $pdf->stream('pdfview.pdf');
        }

        return view('user::machines.createPDF', compact('machines'));
    }
}
