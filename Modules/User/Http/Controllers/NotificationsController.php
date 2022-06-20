<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Notifications;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $notifications = Notifications::latest()->paginate(5);
        return view('user::notifications.index', compact('notifications'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
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

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $notification = Notifications::find($id);
        return view('user::notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $notification = Notifications::find($id);
        return view('user::notifications.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Notifications::find($id)->delete();
        return redirect()->route('notifications.index')->with('message', 'Notification deleted successfully');
    }
}
