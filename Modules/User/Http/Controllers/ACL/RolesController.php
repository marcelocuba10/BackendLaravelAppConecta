<?php

namespace Modules\User\Http\Controllers\ACL;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;

//spatie
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::paginate(10);

        return view('user::roles.index', compact('roles'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $permissions = Permission::get();

        return view('user::roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required'
        ]);

        $role = Role::create(['name' => $request->input('name'),'guard_name' => 'web']);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')->with('message', 'Role created successfully');
    }

    public function show($id)
    {
        $role = DB::table('roles')
                ->select('roles.name','roles.guard_name')
                ->where('roles.id','=',$id)
                ->first();

        return view('user::roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermission = $role->permissions->pluck('name')->toArray();
        //$rolePermission = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
        //->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        //->all();  

        return view('user::roles.edit', compact('role', 'permissions', 'rolePermission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required'
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')->with('message', 'Role updated successfully');
    }

    public function destroy($id)
    {
        DB::table('roles')->where('id', $id)->delete();

        return redirect()->route('roles.index')->with('message', 'Role deleted successfully');
    }
}
