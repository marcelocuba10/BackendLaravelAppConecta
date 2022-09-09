<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);
    }

    public function index()
    {
        $idRefCurrentUser = Auth::user()->idReference;

        $customers = DB::table('customers')
            ->select('customers.id', 'customers.name', 'customers.phone', 'customers.pool', 'customers.total_machines')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->orderBy('customers.created_at', 'DESC')
            ->limit(7)
            ->get();

        $users = DB::table('users')
            ->select('users.id', 'users.name', 'users.status', 'users.email')
            ->where('users.idReference', '=', $idRefCurrentUser)
            ->orderBy('created_at', 'DESC')
            ->paginate(7);

        $cant_customers = DB::table('customers')->where('customers.idReference', '=', $idRefCurrentUser)->count();

        $cant_users = DB::table('users')->where('users.idReference', '=', $idRefCurrentUser)->count();

        $cant_machines = DB::table('machines')
            ->leftjoin('users', 'machines.user_id', '=', 'users.id')
            ->leftjoin('customers', 'machines.customer_id', '=', 'customers.id')
            ->select('users.name AS user_name', 'machines.id', 'machines.name', 'machines.codeQR', 'machines.customer_id', 'machines.status', 'machines.observation', 'customers.name AS customer_name')
            ->where('customers.idReference', '=', $idRefCurrentUser)
            ->count();

        return view('user::dashboard', compact('users', 'customers', 'cant_customers', 'cant_users', 'cant_machines'));
    }
}
