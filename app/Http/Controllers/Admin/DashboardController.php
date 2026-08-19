<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\BlogPost;
use App\Models\Experience;
use App\Models\Message;
use App\Models\PageView;
use App\Models\Project;
use App\Models\Service;
use App\Models\Technology;
use App\Models\Testimonial;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $notifications = AdminNotification::latest()->limit(8)->get();
        $unreadCount = AdminNotification::whereNull('read_at')->count();

        return view('admin.dashboard', [
            'totalProjects' => Project::count(),
            'publishedProjects' => Project::where('status', 'published')->count(),
            'totalServices' => Service::count(),
            'totalClients' => Testimonial::count(),
            'totalExperience' => Experience::count(),
            'totalMessages' => Message::count(),
            'unreadMessages' => Message::where('status', 'unread')->count(),
            'totalSkills' => Technology::count(),
            'totalVisitors' => PageView::count(),
            'totalUsers' => User::count(),
            'totalBlogPosts' => BlogPost::count(),
            'recentProjects' => Project::latest()->limit(5)->get(),
            'recentMessages' => Message::latest()->limit(5)->get(),
            'recentNotifications' => $notifications,
            'unreadCount' => $unreadCount,
            'visitsByDay' => PageView::where('created_at', '>=', now()->subDays(7))
                ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
                ->groupBy('day')
                ->orderBy('day')
                ->pluck('total', 'day'),
        ]);
    }
}