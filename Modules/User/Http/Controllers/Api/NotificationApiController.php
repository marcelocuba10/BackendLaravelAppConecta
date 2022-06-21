<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Notifications;

class NotificationApiController extends Controller
{
    public function index()
    {
        $notifications = Notifications::all();
        return response()->json($notifications);
    }
}
