<?php

namespace Modules\Admin\Http\Controllers\Auth;

//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\SuperUser;
use Modules\Admin\Http\Requests\RegisterRequest;

//add
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function show()
    {
        return view('admin::auth.register');
    }

    public function register(RegisterRequest $request)
    {

        if (empty($request['terms'] || $request['terms'] != 1)) {
            return redirect()->to('/admin/login');
        }

        $user = SuperUser::create($request->validated());
        $user->assignRole('Guest');
        Auth::guard('admin')->login($user);

        return redirect()->to('/admin/dashboard/')->withSuccess('Signed in');
    }
}
