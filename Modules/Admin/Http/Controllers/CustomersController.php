<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $users = User::latest()->paginate(10);

        return view('admin::customers.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        /** get current user role */
        $arrayCurrentUserRole = Auth::user()->roles->pluck('name');
        $currentUserRole = $arrayCurrentUserRole[0];

        $status = [0, 1];

        $user = null;
        $idMaster = null;

        $roles = Role::where('guard_name', '=', 'web')->pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRole = null; //set null for select form not compare with others roles
        return view('admin::customers.create', compact('user', 'roles', 'userRole', 'currentUserRole', 'status', 'idMaster'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'idMaster' => 'required|int',
            'name' => 'required|max:20|min:5',
            'last_name' => 'required|max:20|min:5',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|max:20|min:5',
            'ci' => 'required|max:8|min:5',
            'password' => 'required|max:20|min:5',
            'confirm_password' => 'required|max:20|min:5|same:password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->to('/admin/customers')->with('message', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::where('guard_name', '=', 'web')->pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        //I use this if to capture only the name of the role, otherwise it would bring me the entire array
        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //name rol in position [0] of the array
        }

        return view('admin::customers.show', compact('user', 'userRole'));
    }

    public function edit($id)
    {
        /** get current user role */
        $arrayCurrentUserRole = Auth::user()->roles->pluck('name');
        $currentUserRole = $arrayCurrentUserRole[0];

        $status = [0, 1];

        $user = User::find($id);
        $idMaster = $user->idMaster;

        $roles = Role::where('guard_name', '=', 'web')->pluck('name', 'name')->all(); #get all roles to send only names to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //get only name of the role
        }

        return view('admin::customers.edit', compact('user', 'roles', 'userRole', 'currentUserRole', 'status', 'idMaster'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'idMaster' => 'required|int',
            'name' => 'required|max:20|min:5',
            'last_name' => 'required|max:20|min:5',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|max:20|min:5',
            'ci' => 'required|max:8|min:5',
            'password' => 'nullable|max:20|min:5',
            'confirm_password' => 'nullable|max:20|min:5|same:password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if (empty($input['password'])) {
            $input = Arr::except($input, array('password'));
        } else {
            if (empty($input['confirm_password'])) {
                return redirect()->route('users_.edit.profile', $id)->withErrors('Confirm password')->withInput();
            }
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')
            ->where('model_id', $id)
            ->delete();

        $user->syncRoles($request->input('roles'));
        $user->assignRole($request->input('roles'));

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
