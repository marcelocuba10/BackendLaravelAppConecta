<?php

namespace Modules\Admin\Http\Controllers\ACL;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//spatie
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:post-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $permissions = Permission::paginate(10);

        return view('admin::admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin::admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:super_users,name',
        ]);

        //Permission::create($request->only('name')); old out modular
        // Define a `publish articles` permission for the admin users belonging to the admin guard
        Permission::create(['guard_name' => 'admin', 'name' => $request->only('name')]);

        return redirect()->route('permissions.index')->with('message', 'Permission created successfully!');
    }

    public function show($id)
    {
        return view('admin::admin.permissions.show');
    }

    public function edit($id)
    {
        $title = 'Permission';
        $permission = Permission::find($id);

        return view('admin::admin.permissions.edit', compact('permission', 'title'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($request->only('name'));

        return redirect()->route('permissions.index')->with('message', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('message', 'Permission deleted successfully');
    }
}
