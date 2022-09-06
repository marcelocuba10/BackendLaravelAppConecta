<?php

namespace Modules\Admin\Http\Controllers\ACL;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
//spatie
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:permission-sa-list|permission-sa-create|permission-sa-edit|permission-sa-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:permission-sa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-sa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-sa-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $permissions = DB::table('permissions')
            ->where('guard_name', '=', 'admin')
            ->select('guard_name', 'id', 'name', 'system_permission')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin::permissions.index', compact('permissions'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function getPermissions(Request $request)
    {

        $guard_name = $request->guard_name;

        $permissions = DB::table('permissions')
            ->where('guard_name', '=', $guard_name)
            ->select('guard_name', 'id', 'name', 'system_permission')
            ->orderBy('created_at', 'DESC')
            ->get();

        return View::make('admin::roles._partials.data', compact('permissions'));
    }

    public function create()
    {
        $guard_name = Auth::getDefaultDriver();
        return view('admin::permissions.create', compact('guard_name'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        // Define a `publish articles` permission for the user users belonging to the user guard
        Permission::create(['name' => $request->input('name'), 'guard_name' => 'admin']);
        return redirect()->to('/admin/ACL/permissions')->with('message', 'Permission created successfully!');
    }

    public function show($id)
    {
        $permission = DB::table('permissions')
            ->select('permissions.name', 'permissions.guard_name')
            ->where('permissions.id', '=', $id)
            ->first();

        return view('admin::permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $guard_name = null;
        $permission = Permission::find($id);

        return view('admin::permissions.edit', compact('permission', 'guard_name'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        $input = $request->all();
        $permission = Permission::find($id);
        $permission->update($input);

        return redirect()->to('/admin/ACL/permissions')->with('message', 'Permission updated successfully.');
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

        return view('admin::permissions.index', compact('permissions', 'search'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect()->to('/admin/ACL/permissions')->with('message', 'Permission deleted successfully');
    }
}
