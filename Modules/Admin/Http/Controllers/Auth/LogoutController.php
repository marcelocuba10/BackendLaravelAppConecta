<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{

    public function perform()
    {
        Session::flush();
        
        Auth::logout();

        return redirect()->to('/');
    }
}
