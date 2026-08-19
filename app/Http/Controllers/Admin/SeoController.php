<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function edit()
    {
        return view('admin.seo', [
            'global' => Setting::get('seo.global', [
                'site_title' => 'Amiri Bajuun — Full Stack Developer',
                'meta_description' => 'Full stack developer specializing in Laravel, React and cloud architecture.',
                'keywords' => 'laravel, react, full stack developer, software engineer',
                'author' => 'Amiri Bajuun',
                'canonical_url' => '',
                'og_image' => '',
                'favicon' => '',
            ]),
            'pages' => Setting::get('seo.pages', collect(['Home', 'About', 'Projects', 'Services', 'Experience', 'Blog', 'Contact'])
                ->mapWithKeys(fn ($p) => [
                    strtolower($p) => ['page' => $p, 'seo_title' => '', 'meta_description' => '', 'og_image' => ''],
                ])->all()),
        ]);
    }

    public function update(Request $request)
    {
        $global = $request->validate([
            'site_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'author' => 'nullable|string',
            'canonical_url' => 'nullable|string',
            'og_image' => 'nullable|string',
            'favicon' => 'nullable|string',
        ]);

        Setting::set('seo.global', $global);

        $pages = [];
        $keys = $request->input('page_key', []);
        foreach ($keys as $key) {
            $pages[$key] = [
                'page' => $request->input("page_label.$key", $key),
                'seo_title' => $request->input("seo_title.$key"),
                'meta_description' => $request->input("meta_description.$key"),
                'og_image' => $request->input("og_image.$key"),
            ];
        }

        Setting::set('seo.pages', $pages);

        return back()->with('status', 'SEO settings saved.');
    }
}