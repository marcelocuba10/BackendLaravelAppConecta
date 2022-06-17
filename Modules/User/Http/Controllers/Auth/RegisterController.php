<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{

    public function show()
    {
        return view('user::auth.register');
    }

    public function register(RegisterRequest $request)
    {

        if (empty($request['terms'] || $request['terms'] != 1)) {
            return redirect()->to('/user/login');
        }

        $user = User::create($request->validated());
        Auth()->login($user);

        return redirect()->to('/user/dashboard');
    }
}
