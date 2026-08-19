<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $items = ActivityLog::with('user')
            ->when($request->q, fn ($q) => $q->where('description', 'like', "%{$request->q}%"))
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('admin.activity-logs', ['items' => $items]);
    }

    public function destroy(ActivityLog $log)
    {
        $log->delete();

        return back()->with('status', 'Log entry deleted.');
    }

    public function clear()
    {
        ActivityLog::truncate();

        return back()->with('status', 'Activity logs cleared.');
    }
}