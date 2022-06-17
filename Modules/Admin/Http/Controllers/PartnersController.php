<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

/** add this Controller in replace of comment **/
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\Users;

class PartnersController extends Controller
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
        $partners = Users::latest()->paginate(10);

        return view('admin::partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin::partners.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'nullable|max:20',
            'username' => 'required|max:20|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|max:20|min:5|same:confirm_password',
        ]);

        $input = $request->all();
        $input['terms'] = 1;

        Users::create($input);

        return redirect()->route('partners.index')->with('message', 'Partner created successfully.');
    }

    public function show($id)
    {
        $partner = Users::find($id);

        return view('admin::partners.show', compact('partner'));
    }

    public function edit($id)
    {
        $partner = Users::find($id);

        return view('admin::partners.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:20|min:5',
            'username' => 'required|max:20|min:5',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|max:20|min:5',
            'confirm_password' => 'nullable|max:20|min:5|same:password',
        ]);

        $input = $request->all();

        if (empty($input['password'])) {
            $input = Arr::except($input, array('password'));
        } else {
            if (empty($input['confirm_password'])) {
                return redirect()->route('partners.edit',$id)->withErrors('Confirm password')->withInput();
            }
        }

        $user = Users::find($id);
        $user->update($input);

        return redirect()->route('partners.index')->with('message', 'Partner updated successfully');
    }

    public function destroy($id)
    {
        Users::find($id)->delete();

        return redirect()->route('partners.index')->with('message', 'Partner deleted successfully');
    }
}
