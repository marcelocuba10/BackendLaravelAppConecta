<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\Plans;
use Modules\User\Entities\User;
//spatie
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);

        $this->middleware('permission:customer-sa-list|customer-sa-create|customer-sa-edit|customer-sa-delete', ['only' => ['index']]);
        $this->middleware('permission:customer-sa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-sa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer-sa-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = DB::table('users')
            ->where('exp_date_plan', '!=', '')
            ->select('id', 'name', 'idReference', 'idMaster', 'email')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin::customers.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        /** get current user role */
        $arrayCurrentUserRole = Auth::user()->roles->pluck('name');
        $currentUserRole = $arrayCurrentUserRole[0];

        $status = array(
            array('0', 'Inhabilitado'),
            array('1', 'Habilitado')
        );

        $days = [1, 5, 10, 15, 20, 25, 30];

        $user = null;
        $idMaster = null;

        $plans = DB::table('plans')->get();

        $roles = Role::where('guard_name', '=', 'web')->pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRole = null; //set null for select form not compare with others roles
        $userPlan = null; //set null for select form not compare with others plans
        $user_exp_date_plan = null; //set null for select form not compare with others days

        return view('admin::customers.create', compact('user', 'roles', 'plans', 'userRole', 'userPlan', 'currentUserRole', 'status', 'idMaster', 'days', 'user_exp_date_plan'));
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'idMaster' => 'required|integer|between:0,1',
            'name' => 'required|max:50|min:5',
            'last_name' => 'required|max:50|min:5',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|max:20|min:5',
            'ci' => 'required|max:25|min:5|unique:users,ci',
            'password' => 'required|max:50|min:5',
            'confirm_password' => 'required|max:50|min:5|same:password',
            'roles' => 'required',
            'plan_id' => 'required|integer',
            'exp_date_plan' => 'required|integer|between:1,30',
        ]);

        $input = $request->all();

        // generate idReference unique and random
        $input['idReference'] = $this->generateUniqueCode();
        $input['roles'] = 'Admin';

        //default role is admin, admin is a client in module user.

        DB::table('financials')->insert(
            [
                'customer_id' => $input['idReference'],
                'plan_id' => $input['plan_id'],
                'exp_date_plan' => $input['exp_date_plan'],
                'status' => $input['idMaster'],
                'created_at' => Carbon::now(),
            ]
        );


        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->to('/admin/customers')->with('message', 'User created successfully.');
    }

    public function generateUniqueCode()
    {
        do {
            $idReference = random_int(100000, 999999);
        } while (User::where("idReference", "=", $idReference)->first());

        return $idReference;
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::where('guard_name', '=', 'web')->pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role
        $plans = DB::table('plans')->get();

        $status = array(
            array('0', 'Inhabilitado'),
            array('1', 'Habilitado')
        );

        //I use this if to capture only the name of the role, otherwise it would bring me the entire array
        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //name rol in position [0] of the array
        }

        return view('admin::customers.show', compact('user', 'userRole', 'plans', 'status'));
    }

    public function edit($id)
    {
        /** get current user role */
        $arrayCurrentUserRole = Auth::user()->roles->pluck('name');
        $currentUserRole = $arrayCurrentUserRole[0];

        $status = array(
            array('0', 'Inhabilitado'),
            array('1', 'Habilitado')
        );

        $days = [1, 5, 10, 15, 20, 25, 30];

        $user = User::find($id);
        $idMaster = $user->idMaster;

        $plans = DB::table('plans')->get();

        $userPlan = $user->plan_id; //set null for select form not compare with others plans
        $user_exp_date_plan = $user->exp_date_plan; //set null for select form not compare with others days

        $roles = Role::where('guard_name', '=', 'web')->pluck('name', 'name')->all(); #get all roles to send only names to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //get only name of the role
        }

        return view('admin::customers.edit', compact('user', 'roles', 'plans', 'days', 'userRole', 'userPlan', 'currentUserRole', 'user_exp_date_plan', 'status', 'idMaster'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'idMaster' => 'required|integer|between:0,1',
            'name' => 'required|max:50|min:5',
            'last_name' => 'required|max:50|min:5',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|max:50|min:5',
            'ci' => 'required|max:25|min:5|unique:users,ci,' . $id,
            'password' => 'nullable|max:50|min:5',
            'confirm_password' => 'nullable|max:20|min:5|same:password',
            'roles' => 'required',
            'plan_id' => 'required|integer',
            'exp_date_plan' => 'required|integer|between:1,30',
        ]);

        $input = $request->all();
        $input['roles'] = 'Admin';

        if (empty($input['password'])) {
            $input = Arr::except($input, array('password'));
        } else {
            if (empty($input['confirm_password'])) {
                return redirect()->to('/admin/customers/edit/' . $id)->withErrors('Confirm password')->withInput();
            }
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('financials')->where('customer_id', '=', $user->idReference)->update(
            [
                'plan_id' => $input['plan_id'],
                'exp_date_plan' => $input['exp_date_plan'],
                'status' => $input['idMaster'],
                'updated_at' => Carbon::now(),
            ]
        );

        // DB::table('model_has_roles')
        //     ->where('model_id', $id)
        //     ->delete();

        // $user->syncRoles($request->input('roles'));
        // $user->assignRole($request->input('roles'));

        return redirect()->to('/admin/customers')->with('message', 'Registro actualizado correctamente');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            $users = DB::table('users')->paginate(10);
        } else {
            $users = DB::table('users')
                ->where('users.name', 'LIKE', "%{$search}%")
                ->paginate();
        }

        return view('admin::customers.index', compact('users', 'search'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->to('/admin/customers')->with('message', 'User deleted successfully');
    }
}
