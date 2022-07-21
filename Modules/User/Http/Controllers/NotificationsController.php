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
        $request->validate([
            'title' => 'required|max:100|min:5',
            'date' => 'required',
            'subject' => 'required|max:255|min:5',
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
        $request->validate([
            'title' => 'required|max:100|min:5',
            'date' => 'required',
            'subject' => 'required|max:255|min:5',
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
