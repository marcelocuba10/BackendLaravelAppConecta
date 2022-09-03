<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\Customers;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\UpdateRequest;

//spatie
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);

        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $currentUser = Auth::user();
        $currentUserId = $currentUser->id;
        $idReference = $currentUser->idReference;

        $users = DB::table('users')
            ->where('idReference', '=', $idReference)
            ->select('id', 'name', 'idReference', 'idMaster', 'email')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('user::users.index', compact('users', 'currentUserId'))->with('i', (request()->input('page', 1) - 1) * 10);
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

        $user = null;
        $idMaster = null;

        $roles = Role::where('guard_name', '=', 'web')
            ->where('name', '!=', 'Admin')
            ->pluck('name', 'name')
            ->all();

        $userRole = null; //set null for select form not compare with others roles
        return view('user::users.create', compact('user', 'roles', 'userRole', 'currentUserRole', 'status', 'idMaster'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:5',
            'last_name' => 'required|max:50|min:5',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|max:20|min:5',
            'ci' => 'required|max:25|min:5|unique:users,ci',
            'password' => 'required|max:50|min:5',
            'confirm_password' => 'required|max:50|min:5|same:password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        $user = Auth::user();
        $input['idMaster'] = 1; //enable login
        $input['plan_id'] = $user->plan_id;
        $input['idReference'] = $user->idReference;

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('message', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::where('guard_name', '=', 'web')
            ->where('name', '!=', 'Admin')
            ->pluck('name', 'name')
            ->all();

        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role
        $plans = DB::table('plans')->get();

        //I use this if to capture only the name of the role, otherwise it would bring me the entire array
        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //name rol in position [0] of the array
        }

        return view('user::users.show', compact('user', 'userRole', 'plans'));
    }

    public function showProfile($id)
    {
        $user = User::find($id);
        $roles = Role::where('guard_name', '=', 'web')
            ->where('name', '!=', 'Admin')
            ->pluck('name', 'name')
            ->all();

        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        /** get current user role */
        $arrayCurrentUserRole = Auth::user()->roles->pluck('name');
        $currentUserRole = $arrayCurrentUserRole[0];

        $cant_customers = Customers::count();

        //I use this if to capture only the name of the role, otherwise it would bring me the entire array
        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //name rol in position [0] of the array
        }

        return view('user::users.profile', compact('user', 'userRole', 'cant_customers', 'currentUserRole'));
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

        $user = User::find($id);
        $idMaster = $user->idMaster;
        $roles = Role::where('guard_name', '=', 'web')
            ->where('name', '!=', 'Admin')
            ->pluck('name', 'name')
            ->all();

        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //get only name of the role
        }

        return view('user::users.edit', compact('user', 'roles', 'userRole', 'currentUserRole', 'status', 'idMaster'));
    }

    public function editProfile($id)
    {
        /** get current user role */
        $arrayCurrentUserRole = Auth::user()->roles->pluck('name');
        $currentUserRole = $arrayCurrentUserRole[0];

        $user = User::find($id);
        $roles = Role::where('guard_name', '=', 'web')
            ->where('name', '!=', 'Admin')
            ->pluck('name', 'name')
            ->all();

        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        $plans = DB::table('plans')->get();

        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //get only name of the role
        }

        return view('user::users.editProfile', compact('user', 'roles', 'userRole', 'currentUserRole', 'plans'));
    }

    public function update(Request $request, $id)
    {
        /** get current user role */
        $arrayCurrentUserRole = Auth::user()->roles->pluck('name');
        $currentUserRole = $arrayCurrentUserRole[0];

        $this->validate($request, [
            'idMaster' => 'required|integer|between:0,1',
            'name' => 'required|max:50|min:5',
            'last_name' => 'required|max:50|min:5',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|max:50|min:5',
            'ci' => 'required|max:25|min:5|unique:users,ci,' . $id,
            'password' => 'nullable|max:50|min:5',
            'confirm_password' => 'nullable|max:50|min:5|same:password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if (empty($input['password'])) {
            $input = Arr::except($input, array('password'));
        } else {
            if (empty($input['confirm_password'])) {
                return redirect()->to('/user/users/edit/' . $id)->withErrors('Confirm password')->withInput();
            }
        }

        $user = User::find($id);
        if ($currentUserRole != "Admin") {
            $input['idMaster'] = $user->idMaster;
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->syncRoles($request->input('roles'));
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('message', 'Registro actualizado correctamente');
    }

    public function updateProfile($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:5',
            'last_name' => 'required|max:50|min:5',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|max:50|min:5',
            'ci' => 'required|max:25|min:5|unique:users,ci,' . $id,
            'password' => 'nullable|max:50|min:5',
            'confirm_password' => 'nullable|max:50|min:5|same:password',
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
        /** keep the plan_id assigned */
        $input['plan_id'] = $user->plan_id;

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->syncRoles($request->input('roles'));
        $user->assignRole($request->input('roles'));

        return redirect()->route('users_.show.profile', compact('user'))->with('message', 'User Profile updated successfully');
    }

    public function search(Request $request)
    {
        $currentUserId = Auth::user()->id;
        $idRefCurrentUser = Auth::user()->idReference;
        $search = $request->input('search');

        if ($search == '') {
            $users = DB::table('users')
                ->select('users.id', 'users.name', 'users.idReference', 'users.idMaster', 'users.email')
                ->where('users.idReference', '=', $idRefCurrentUser)
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        } else {
            $users = DB::table('users')
                ->select('users.id', 'users.name', 'users.idReference', 'users.idMaster', 'users.email')
                ->where('users.name', 'LIKE', "%{$search}%")
                ->where('users.idReference', '=', $idRefCurrentUser)
                ->orderBy('created_at', 'DESC')
                ->paginate();
        }

        return view('user::users.index', compact('users', 'search', 'currentUserId'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('message', 'User deleted successfully');
    }
}
