<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Notifications;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['logout']]);

        $this->middleware('permission:notification-list|notification-create|notification-edit|notification-delete', ['only' => ['index']]);
        $this->middleware('permission:notification-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:notification-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:notification-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $notifications = Notifications::latest()->paginate(5);
        return view('user::notifications.index', compact('notifications'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('user::notifications.create');
    }

    public function store(Request $request)
    {
        //date validation, not less than 1980 and not greater than the current year
        $initialDate = '1980-01-01';
        $currentDate = (date('Y')+1).'-01-01'; //2023-01-01

        $request->validate([
            'title' => 'required|max:50|min:5',
            'date' => 'required|date_format:Y-m-d|after_or_equal:'.$initialDate.'|before:'.$currentDate,
            'subject' => 'required|max:150|min:5',
        ]);

        Notifications::create($request->all());

        return redirect()->route('notifications.index')->with('message', 'Notification created successfully.');
    }

    public function show($id)
    {
        $notification = Notifications::find($id);
        return view('user::notifications.show', compact('notification'));
    }

    public function edit($id)
    {
        $notification = Notifications::find($id);
        return view('user::notifications.edit', compact('notification'));
    }

    public function update(Request $request, $id)
    {
        //date validation, not less than 1980 and not greater than the current year
        $initialDate = '1980-01-01';
        $currentDate = (date('Y')+1).'-01-01'; //2023-01-01

        $request->validate([
            'title' => 'required|max:50|min:5',
            'date' => 'required|date_format:Y-m-d|after_or_equal:'.$initialDate.'|before:'.$currentDate,
            'subject' => 'required|max:150|min:5',
        ]);

        $notification = Notifications::find($id);
        $notification->update($request->all());

        return redirect()->route('notifications.index')->with('message', 'Notification updated successfully.');
    }

    public function destroy($id)
    {
        Notifications::find($id)->delete();
        return redirect()->route('notifications.index')->with('message', 'Notification deleted successfully');
    }
}
