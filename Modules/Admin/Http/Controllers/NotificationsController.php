<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\Notifications;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);

        $this->middleware('permission:notification-sa-list|notification-sa-create|notification-sa-edit|notification-sa-delete', ['only' => ['index']]);
        $this->middleware('permission:notification-sa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:notification-sa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:notification-sa-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $notifications = DB::table('notifications')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('admin::notifications.index', compact('notifications'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin::notifications.create');
    }

    public function store(Request $request)
    {
        //date validation, not less than 1980 and not greater than the current year
        $initialDate = '1980-01-01';
        $currentDate = (date('Y') + 1) . '-01-01'; //2023-01-01

        $request->validate([
            'title' => 'required|max:50|min:5',
            'date' => 'required|date_format:Y-m-d|after_or_equal:today|before:' . $currentDate,
            'subject' => 'required|max:150|min:5',
        ]);

        Notifications::create($request->all());

        return redirect()->to('/admin/notifications')->with('message', 'Notification created successfully.');
    }

    public function show($id)
    {
        $notification = DB::table('notifications')
            ->where('notifications.id', '=', $id)
            ->first();

        return view('admin::notifications.show', compact('notification'));
    }

    public function edit($id)
    {
        $notification = DB::table('notifications')
            ->where('notifications.id', '=', $id)
            ->first();

        return view('admin::notifications.edit', compact('notification'));
    }

    public function update(Request $request, $id)
    {
        //date validation, not less than 1980 and not greater than the current year
        $initialDate = '1980-01-01';
        $currentDate = (date('Y') + 1) . '-01-01'; //2023-01-01

        $request->validate([
            'title' => 'required|max:50|min:5',
            'date' => 'required|date_format:Y-m-d|after_or_equal:today|before:' . $currentDate,
            'subject' => 'required|max:150|min:5',
        ]);

        $notification = Notifications::find($id);
        $notification->update($request->all());

        return redirect()->to('/admin/notifications')->with('message', 'Notification updated successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            $notifications = DB::table('notifications')->paginate(10);
        } else {
            $notifications = DB::table('notifications')
                ->where('notifications.title', 'LIKE', "%{$search}%")
                ->orWhere('notifications.subject', 'LIKE', "%{$search}%")
                ->paginate();
        }

        return view('admin::notifications.index', compact('notifications', 'search'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function destroy($id)
    {
        Notifications::find($id)->delete();
        return redirect()->to('/admin/notifications')->with('message', 'Notification deleted successfully');
    }
}
