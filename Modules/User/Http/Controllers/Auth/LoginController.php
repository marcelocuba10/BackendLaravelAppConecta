<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\LoginRequest;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function show()
    {
        return view('user::auth.login');
    }

    public function login(Request $request)
    {
        //$credentials = $request->getCredentials();

        $credentials = $request->validate([
            'email' => 'required|email|min:6|max:100',
            'password' => 'required|min:6|max:50'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        /** Validations */
        $user = User::where('email', '=', $email)->first();

        if (!$user) {
            return redirect()->to('/user/login')->with('error', 'Correo electrónico no encontrado.');
        }

        if (!Hash::check($password, $user->password)) {
            return redirect()->to('/user/login')->with('error', 'Contraseña incorrecta.');
        }

        if (!Auth::validate($credentials)) {
            return redirect()->to('/user/login')->with('error', 'Credenciales incorrectas');
        }

        /** Check if user is enabled or disabled */
        if ($user->idMaster == 0) {
            return redirect()->to('/user/login')->with('error', 'Usuario inhabilitado');
        } else {
            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            // Auth::login($user);
            Auth::login($user, $request->get('remember'));
            return $this->authenticated($request, $user);
        }
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->to('/user/dashboard');
    }
}
