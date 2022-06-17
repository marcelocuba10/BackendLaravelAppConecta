<?php

namespace Modules\User\Http\Controllers\ACL;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//spatie
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $permissions = Permission::paginate(10);

        return view('user::permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('user::permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:super_users,name',
        ]);

        //Permission::create($request->only('name')); old out modular
        // Define a `publish articles` permission for the user users belonging to the user guard
        Permission::create(['guard_name' => 'web', 'name' => $request->only('name')]);

        return redirect()->route('permissions.index')->with('message', 'Permission created successfully!');
    }

    public function show($id)
    {
        return view('user::permissions.show');
    }

    public function edit($id)
    {
        $title = 'Permission';
        $permission = Permission::find($id);

        return view('user::permissions.edit', compact('permission', 'title'));
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
