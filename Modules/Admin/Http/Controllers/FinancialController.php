<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class FinancialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);

        $this->middleware('permission:movement-sa-list|movement-sa-create|movement-sa-edit|movement-sa-delete', ['only' => ['index']]);
        $this->middleware('permission:movement-sa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:movement-sa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:movement-sa-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $finances = DB::table('financials')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin::financial.index', compact('finances'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function show($id)
    {
        $finances = DB::table('financials')
            ->where('financials.id', '=', $id)
            ->first();

        return view('admin::plans.show', compact('finances'));
    }
}
