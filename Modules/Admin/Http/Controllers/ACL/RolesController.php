<?php

namespace Modules\Admin\Http\Controllers\ACL;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

//spatie
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class RolesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-sa-list|role-sa-create|role-sa-edit|role-sa-delete', ['only' => ['index']]);
        $this->middleware('permission:role-sa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-sa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-sa-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $guard_name = Auth::getDefaultDriver();
        $roles = DB::table('roles')
            ->leftjoin('users', 'roles.idReference', '=', 'users.idReference')
            ->select('roles.guard_name', 'roles.id', 'roles.name', 'roles.system_role', 'roles.idReference', 'users.name AS customer_name', 'users.idReference AS customer_idReference')
            ->orderBy('roles.created_at', 'DESC')
            ->paginate(10);

        return view('admin::roles.index', compact('roles', 'guard_name'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $guard_name = Auth::getDefaultDriver();

        $roleGuard = null;
        $system_role = null;
        $guard_names = Role::pluck('guard_name', 'guard_name')->all();

        $keys = array(
            array('0', 'No'),
            array('1', 'Si')
        );

        $permissions = DB::table('permissions')
            //->where('guard_name', '=', 'admin')
            ->select('guard_name', 'id', 'name', 'system_permission')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin::roles.create', compact('permissions', 'keys', 'system_role', 'guard_names', 'roleGuard'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
            'system_role' => 'required',
            'guard_name' => 'required'
        ]);

        /** Create idReference; by default it is 6 characters, to create a unique string, I remove 2 characters */
        $idReference = substr(Auth::user()->id, 0, -2);

        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => $request->input('guard_name'),
            'system_role' => $request->input('system_role'),
            'idReference' => $idReference
        ]);

        $role->syncPermissions($request->input('permission'));

        return redirect()->to('/admin/ACL/roles')->with('message', 'Role created successfully');
    }

    public function show($id)
    {
        $role = Role::find($id);

        $keys = array(
            array('0', 'No'),
            array('1', 'Si')
        );

        $permissions = Permission::get();
        $rolePermission = $role->permissions->pluck('name')->toArray();

        //dd($rolePermission);
        return view('admin::roles.show', compact('role', 'rolePermission', 'keys'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $roleGuard = $role->guard_name;
        $system_role = $role->system_role;
        $guard_names = Role::pluck('guard_name', 'guard_name')->all();

        $keys = array(
            array('0', 'No'),
            array('1', 'Si')
        );

        $permissions = DB::table('permissions')
            //->where('guard_name', '=', $role->guard_name)
            ->select('guard_name', 'id', 'name', 'system_permission')
            ->orderBy('created_at', 'DESC')
            ->get();

        $rolePermission = $role->permissions->pluck('name')->toArray();

        return view('admin::roles.edit', compact('role', 'permissions', 'rolePermission', 'roleGuard', 'keys', 'system_role', 'guard_names'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $id,
            'permission' => 'required',
            'system_role' => 'required',
            'guard_name' => 'required'
        ]);

        $input = $request->all();
        $role = Role::find($id);
        $role->update($input);

        $role->syncPermissions($request->input('permission'));

        return redirect()->to('/admin/ACL/roles')->with('message', 'Role updated successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $guard_name = Auth::getDefaultDriver();

        if ($search == '') {
            $roles = DB::table('roles')
                ->leftjoin('users', 'roles.idReference', '=', 'users.idReference')
                ->select('roles.guard_name', 'roles.id', 'roles.name', 'roles.system_role', 'roles.idReference', 'users.name AS customer_name', 'users.idReference AS customer_idReference')
                ->orderBy('roles.created_at', 'DESC')
                ->paginate(10);
        } else {
            $roles = DB::table('roles')
                ->leftjoin('users', 'roles.idReference', '=', 'users.idReference')
                ->select('roles.guard_name', 'roles.id', 'roles.name', 'roles.system_role', 'roles.idReference', 'users.name AS customer_name', 'users.idReference AS customer_idReference')
                ->where('roles.name', 'LIKE', "%{$search}%")
                ->orderBy('roles.created_at', 'DESC')
                ->paginate();
        }

        return view('admin::roles.index', compact('roles', 'search', 'guard_name'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        DB::table('roles')->where('id', $id)->delete();
        return redirect()->to('/admin/ACL/roles')->with('message', 'Role deleted successfully');
    }
}
