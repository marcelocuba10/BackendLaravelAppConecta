<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\SuperUser;

//spatie
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);

        $this->middleware('permission:user-sa-list|user-sa-create|user-sa-edit|user-sa-delete', ['only' => ['index']]);
        $this->middleware('permission:user-sa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-sa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-sa-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $currentUserId = Auth::id();
        $users = SuperUser::latest()->paginate(10);

        return view('admin::users.index', compact('users', 'currentUserId'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        /** get current user role */
        $arrayCurrentUserRole = Auth::user()->roles->pluck('name');
        $currentUserRole = $arrayCurrentUserRole[0];

        $user = null;
        $roles = Role::where('guard_name', '=', 'admin')->pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRole = null; //set null for select form not compare with others roles
        return view('admin::users.create', compact('user', 'roles', 'userRole', 'currentUserRole'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:5',
            'last_name' => 'required|max:50|min:5',
            'email' => 'required|email|unique:super_users,email',
            'phone' => 'nullable|max:20|min:5',
            'ci' => 'required|max:25|min:5',
            'password' => 'required|max:50|min:5',
            'confirm_password' => 'required|max:50|min:5|same:password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        $user = SuperUser::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->to('/admin/users')->with('message', 'User created successfully.');
    }

    public function show($id)
    {
        $user = SuperUser::find($id);
        $roles = Role::where('guard_name', '=', 'admin')->pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        //I use this if to capture only the name of the role, otherwise it would bring me the entire array
        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //name rol in position [0] of the array
        }

        return view('admin::users.show', compact('user', 'userRole'));
    }

    public function showProfile($id)
    {
        $user = SuperUser::find($id);
        $roles = Role::where('guard_name', '=', 'admin')->pluck('name', 'name')->all(); //get all roles to send only names to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        //I use this if to capture only the name of the role, otherwise it would bring me the entire array
        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //name rol in position [0] of the array
        }

        return view('admin::users.profile', compact('user', 'userRole'));
    }

    public function edit($id)
    {
        /** get current user role */
        $arrayCurrentUserRole = Auth::user()->roles->pluck('name');
        $currentUserRole = $arrayCurrentUserRole[0];

        $user = SuperUser::find($id);
        $roles = Role::where('guard_name', '=', 'admin')->pluck('name', 'name')->all(); #get all roles to send only names to form
        //$roles = Role::all(); //get all roles to send array to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //get only name of the role
        }

        return view('admin::users.edit', compact('user', 'roles', 'userRole', 'currentUserRole'));
    }

    public function editProfile($id)
    {
        /** get current user role */
        $arrayCurrentUserRole = Auth::user()->roles->pluck('name');
        $currentUserRole = $arrayCurrentUserRole[0];

        $user = SuperUser::find($id);
        $roles = Role::where('guard_name', '=', 'admin')->pluck('name', 'name')->all(); #get all roles to send only names to form
        //$roles = Role::all(); //get all roles to send array to form
        $userRoleArray = $user->roles->pluck('name')->toArray(); //get user assigned role

        if (empty($userRoleArray)) {
            $userRole = null;
        } else {
            $userRole = $userRoleArray[0]; //get only name of the role
        }

        return view('admin::users.editProfile', compact('user', 'roles', 'userRole', 'currentUserRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:5',
            'last_name' => 'required|max:50|min:5',
            'email' => 'required|email|unique:super_users,email,' . $id,
            'phone' => 'nullable|max:20|min:5',
            'ci' => 'required|max:25|min:5',
            'password' => 'nullable|max:50|min:5',
            'confirm_password' => 'nullable|max:50|min:5|same:password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if (empty($input['password'])) {
            $input = Arr::except($input, array('password'));
        } else {
            if (empty($input['confirm_password'])) {
                return redirect()->to('/admin/users/edit/' . $id)->withErrors('Confirm password')->withInput();
            }
        }

        $user = SuperUser::find($id);

        //to reforce email validation. I place again the email that the user previously saved.
        $input['email'] = $user->email;

        //update data
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->syncRoles($request->input('roles'));
        $user->assignRole($request->input('roles'));

        return redirect()->to('/admin/users')->with('message', 'Registro actualizado correctamente');
    }

    public function updateProfile($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:5',
            'last_name' => 'required|max:50|min:5',
            'email' => 'required|email|unique:super_users,email,' . $id,
            'phone' => 'nullable|max:20|min:5',
            'ci' => 'required|max:25|min:5',
            'password' => 'nullable|max:50|min:5',
            'confirm_password' => 'nullable|max:50|min:5|same:password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if (empty($input['password'])) {
            $input = Arr::except($input, array('password'));
        } else {
            if (empty($input['confirm_password'])) {
                return redirect()->to('/admin/users/edit/profile/' . $id)->withErrors('Confirm password')->withInput();
            }
        }

        $user = SuperUser::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->syncRoles($request->input('roles'));
        $user->assignRole($request->input('roles'));

        return redirect()->to('/admin/users/profile/' . $id)->with('message', 'User Profile updated successfully');
    }

    public function search(Request $request)
    {
        $currentUser = Auth::user();
        $currentUserId = $currentUser->id;
        $search = $request->input('search');

        if ($search == '') {
            $users = DB::table('super_users')->paginate(10);
        } else {
            $users = DB::table('super_users')
                ->where('super_users.name', 'LIKE', "%{$search}%")
                ->paginate();
        }

        return view('admin::users.index', compact('users', 'search', 'currentUserId'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        SuperUser::find($id)->delete();
        return redirect()->to('/admin/users')->with('message', 'User deleted successfully');
    }
}
