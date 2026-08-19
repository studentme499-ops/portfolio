<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageView;

class AnalyticsController extends Controller
{
    public function index()
    {
        $start = now()->subDays(30);

        $totals = [
            'visitors' => PageView::count(),
            'unique' => PageView::distinct('ip_address')->count('ip_address'),
            'page_views' => PageView::count(),
            'conversions' => \App\Models\Message::count(),
        ];

        $byDay = PageView::where('created_at', '>=', $start)
            ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day');

        $devices = PageView::where('created_at', '>=', $start)
            ->selectRaw('COALESCE(device, "desktop") as device, COUNT(*) as total')
            ->groupBy('device')
            ->pluck('total', 'device');

        $browsers = PageView::where('created_at', '>=', $start)
            ->selectRaw('COALESCE(browser, "unknown") as browser, COUNT(*) as total')
            ->groupBy('browser')
            ->orderByDesc('total')
            ->pluck('total', 'browser');

        $countries = PageView::where('created_at', '>=', $start)
            ->selectRaw('COALESCE(country, "Unknown") as country, COUNT(*) as total')
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(8)
            ->pluck('total', 'country');

        $topPaths = PageView::where('created_at', '>=', $start)
            ->selectRaw('COALESCE(path, "/") as path, COUNT(*) as total')
            ->groupBy('path')
            ->orderByDesc('total')
            ->limit(10)
            ->pluck('total', 'path');

        // Build 30-day series filling gaps
        $days = [];
        $series = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $days[] = now()->subDays($i)->format('D');
            $series[] = $byDay[$date] ?? 0;
        }

        return view('admin.analytics', [
            'totals' => $totals,
            'days' => $days,
            'series' => $series,
            'max' => max(1, max($series)),
            'devices' => $devices,
            'browsers' => $browsers,
            'countries' => $countries,
            'topPaths' => $topPaths,
        ]);
    }
}