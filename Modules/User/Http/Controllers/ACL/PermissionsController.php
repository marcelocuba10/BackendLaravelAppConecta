<?php

namespace Modules\User\Http\Controllers\ACL;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

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
        $permissions = DB::table('permissions')
            ->where('guard_name', '=', 'web')
            ->select('guard_name', 'id', 'name', 'system_permission')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('user::permissions.index', compact('permissions'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('user::permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        // Define a `publish articles` permission for the user users belonging to the user guard
        Permission::create(['name' => $request->input('name'), 'guard_name' => 'web']);
        return redirect()->route('permissions.user.index')->with('message', 'Permission created successfully!');
    }

    public function show($id)
    {
        $permission = DB::table('permissions')
            ->select('permissions.name', 'permissions.guard_name')
            ->where('permissions.id', '=', $id)
            ->first();

        return view('user::permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $title = 'Permission';
        $permission = Permission::find($id);

        return view('user::permissions.edit', compact('permission', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        $input = $request->all();
        $permission = Permission::find($id);
        $permission->update($input);

        return redirect()->route('permissions.user.index')->with('message', 'Permission updated successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            $permissions = DB::table('permissions')->paginate(10);
        } else {
            $permissions = DB::table('permissions')
                ->where('permissions.name', 'LIKE', "%{$search}%")
                ->paginate();
        }

        return view('user::permissions.index', compact('permissions', 'search'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect()->route('permissions.user.index')->with('message', 'Permission deleted successfully');
    }
}
