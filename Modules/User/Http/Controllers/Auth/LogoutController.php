<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    
    public function perform()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('/');
    }
}
