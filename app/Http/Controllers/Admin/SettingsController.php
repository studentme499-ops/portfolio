<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        return view('admin.settings', [
            'general' => Setting::get('settings.general', [
                'website_name' => 'Amiri Bajuun',
                'logo' => '',
                'favicon' => '',
                'timezone' => 'Africa/Dar_es_Salaam',
                'language' => 'en',
            ]),
            'appearance' => Setting::get('settings.appearance', [
                'primary_color' => '#635bff',
                'dark_mode' => true,
            ]),
            'footer' => Setting::get('settings.footer', [
                'copyright' => '© 2026 Amiri Bajuun. All rights reserved.',
                'footer_description' => 'Full stack developer building scalable web experiences.',
            ]),
        ]);
    }

    public function update(Request $request)
    {
        Setting::set('settings.general', $request->only([
            'website_name', 'logo', 'favicon', 'timezone', 'language',
        ]));

        Setting::set('settings.appearance', [
            'primary_color' => $request->primary_color,
            'dark_mode' => $request->boolean('dark_mode'),
        ]);

        Setting::set('settings.footer', $request->only([
            'copyright', 'footer_description',
        ]));

        return back()->with('status', 'Settings saved.');
    }
}