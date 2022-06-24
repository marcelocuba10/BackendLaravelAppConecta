<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class QrCodeController extends Controller
{
    public function index()
    {
      return view('user::qrcode');
    }
}
