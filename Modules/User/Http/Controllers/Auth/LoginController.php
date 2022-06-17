<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
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
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::validate($credentials)) {
            return redirect()->to('/user/login')->withErrors('Wrong Credentials');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->to('/user/dashboard');
    }
}
