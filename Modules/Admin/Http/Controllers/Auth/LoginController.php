<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Hash;
use Modules\Admin\Entities\SuperUser;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function show()
    {
        return view('admin::auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email'   => 'required|email|min:6|max:100',
            'password' => 'required|min:6|max:50'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = SuperUser::where('email', '=', $email)->first();

        if (!$user) {
            return redirect()->to('/admin/login')->with('error', 'Correo electrónico no encontrado.');
        }

        if (!Hash::check($password, $user->password)) {
            return redirect()->to('/admin/login')->with('error', 'Contraseña incorrecta.');
        }

        Auth::guard('admin')->login($user, $request->get('remember'));
        return redirect()->to('/admin/dashboard');
    }
}
