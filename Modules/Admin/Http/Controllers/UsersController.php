<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

//spatie
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/** add this Controller in replace of comment **/
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\SuperUser;

class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = SuperUser::latest()->paginate(10);

        return view('admin::users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRole = null; //set null for select form not compare with others roles
        return view('admin::users.create', compact('roles', 'userRole'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'nullable|max:20',
            'username' => 'required|max:20|min:5',
            'email' => 'required|email|unique:super_users,email',
            'password' => 'required|max:20|min:5|same:confirm_password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['terms'] = 1;

        $user = SuperUser::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('message', 'User created successfully.');
    }

    public function show($id)
    {
        $user = SuperUser::find($id);
        $roles = Role::pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //get only name of the role
        }

        return view('admin::users.show', compact('user', 'userRole'));
    }

    public function showProfile($id)
    {
        $user = SuperUser::find($id);

        return view('admin::users.profile', compact('user'));
    }

    public function edit($id)
    {
        $user = SuperUser::find($id);
        $roles = Role::pluck('name', 'name')->all(); #get all roles to send only names to form
        //$roles = Role::all(); //get all roles to send array to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //get only name of the role
        }

        return view('admin::users.edit', compact('user', 'roles', 'userRole'));
    }

    public function editProfile($id)
    {
        $user = SuperUser::find($id);
        $roles = Role::pluck('name', 'name')->all(); #get all roles to send only names to form
        //$roles = Role::all(); //get all roles to send array to form
        $userRoleArray = $user->roles->pluck('name')->toArray();

        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0];
        }

        return view('admin::users.editProfile', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:20|min:5',
            'username' => 'required|max:20|min:5',
            'email' => 'required|email|unique:super_users,email,' . $id,
            'password' => 'nullable|max:20|min:5',
            'confirm_password' => 'nullable|max:20|min:5|same:password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if (empty($input['password'])) {
            $input = Arr::except($input, array('password'));
        } else {
            if (empty($input['confirm_password'])) {
                return redirect()->route('users.edit', $id)->withErrors('Confirm password')->withInput();
            }
        }

        $user = SuperUser::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete(); //si estamos actualizando el rol del user, eliminamos el id

        $user->syncRoles($request->input('roles'));
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('message', 'User updated successfully');
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:20|min:5',
            'username' => 'required|max:20|min:5',
            'email' => 'required|email|unique:super_users,email,' . $id,
            'password' => 'nullable|max:20|min:5',
            'confirm_password' => 'nullable|max:20|min:5|same:password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if (empty($input['password'])) {
            $input = Arr::except($input, array('password'));
        } else {
            if (empty($input['confirm_password'])) {
                return redirect()->route('users.edit.profile', $id)->withErrors('Confirm password')->withInput();
            }
        }

        $user = SuperUser::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete(); //si estamos actualizando el rol del user, eliminamos el id

        $user->syncRoles($request->input('roles'));
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.show.profile', $user->id)->with('message', 'User updated successfully');
    }

    public function destroy($id)
    {
        SuperUser::find($id)->delete();

        return redirect()->route('users.index')->with('message', 'User deleted successfully');
    }
}
