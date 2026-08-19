<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;

class NotificationController extends Controller
{
    public function index()
    {
        return view('admin.notifications.index', [
            'items' => AdminNotification::latest()->paginate(20),
        ]);
    }

    public function markRead(AdminNotification $notification)
    {
        $notification->update(['read_at' => now()]);

        return back();
    }

    public function markAllRead()
    {
        AdminNotification::whereNull('read_at')->update(['read_at' => now()]);

        return back()->with('status', 'All notifications marked as read.');
    }

    public function destroy(AdminNotification $notification)
    {
        $notification->delete();

        return back()->with('status', 'Notification deleted.');
    }
}