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
            ->where('guard_name', '=', 'admin')
            ->select('guard_name', 'id', 'name', 'system_role')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin::roles.index', compact('roles','guard_name'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $guard_name = Auth::getDefaultDriver();
        $permissions = DB::table('permissions')
            ->where('guard_name', '=', 'admin')
            ->select('guard_name', 'id', 'name', 'system_permission')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin::roles.create', compact('permissions', 'guard_name'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'admin']);
        $role->syncPermissions($request->input('permission'));

        return redirect()->to('/admin/ACL/roles')->with('message', 'Role created successfully');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermission = $role->permissions->pluck('name')->toArray();

        //dd($rolePermission);
        return view('admin::roles.show', compact('role', 'rolePermission'));
    }

    public function edit($id)
    {
        $guard_name = null;
        $role = Role::find($id);

        $permissions = DB::table('permissions')
            ->where('guard_name', '=', 'admin')
            ->select('guard_name', 'id', 'name', 'system_permission')
            ->orderBy('created_at', 'DESC')
            ->get();

        $rolePermission = $role->permissions->pluck('name')->toArray();
        //$rolePermission = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
        //->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        //->all();  

        return view('admin::roles.edit', compact('role', 'permissions', 'rolePermission', 'guard_name'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $id,
            'permission' => 'required'
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->to('/admin/ACL/roles')->with('message', 'Role updated successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            $roles = DB::table('roles')->paginate(10);
        } else {
            $roles = DB::table('roles')
                ->where('roles.name', 'LIKE', "%{$search}%")
                ->paginate();
        }

        return view('admin::roles.index', compact('roles', 'search'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        DB::table('roles')->where('id', $id)->delete();
        return redirect()->to('/admin/ACL/roles')->with('message', 'Role deleted successfully');
    }
}
