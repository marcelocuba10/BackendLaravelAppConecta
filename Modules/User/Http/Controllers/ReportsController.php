<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Reports;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);
    }


    public function index()
    {
        $reports = Reports::latest()->paginate(5);
        return view('user::reports.index', compact('reports'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('user::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('user::show');
    }

    public function edit($id)
    {
        $report = Reports::find($id);

        return view('user::reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        
    }
}
