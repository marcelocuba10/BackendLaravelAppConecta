<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $users = User::latest()->paginate(10);

        return view('user::users.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $user = null;
        $roles = Role::pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRole = null; //set null for select form not compare with others roles
        return view('user::users.create', compact('user', 'roles', 'userRole'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
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

        return redirect()->route('users.index')->with('message', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        //I use this if to capture only the name of the role, otherwise it would bring me the entire array
        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //name rol in position [0] of the array
        }

        return view('user::users.show', compact('user', 'userRole'));
    }

    public function showProfile($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        //I use this if to capture only the name of the role, otherwise it would bring me the entire array
        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //name rol in position [0] of the array
        }

        return view('user::users.profile', compact('user', 'userRole'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all(); #get all roles to send only names to form
        //$roles = Role::all(); //get all roles to send array to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //get only name of the role
        }

        return view('user::users.edit', compact('user', 'roles', 'userRole'));
    }

    public function editProfile($id)
    {
        $user = User::find($id);

        $roles = Role::pluck('name', 'name')->all(); #get all roles to send only names to form
        //$roles = Role::all(); //get all roles to send array to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //get only name of the role
        }

        return view('user::users.editProfile', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
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
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->syncRoles($request->input('roles'));
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('message', 'Registro actualizado correctamente');
    }

    public function updateProfile($id, Request $request)
    {

        $this->validate($request, [
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
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->syncRoles($request->input('roles'));
        $user->assignRole($request->input('roles'));

        return redirect()->route('users_.show.profile', compact('user'))->with('message', 'User Profile updated successfully');
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

        return view('user::users.index', compact('users', 'search'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('message', 'User deleted successfully');
    }
}
