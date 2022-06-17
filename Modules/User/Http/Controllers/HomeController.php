<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);
    }

    public function index()
    {
        return view('user::dashboard');
    }
}
