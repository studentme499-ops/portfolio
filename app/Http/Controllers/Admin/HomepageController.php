<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function edit()
    {
        return view('admin.homepage', [
            'hero' => Setting::get('homepage.hero', [
                'eyebrow' => 'Full Stack Developer',
                'heading' => 'Building Digital Experiences With Clean Code & Modern Tech',
                'description' => 'Senior full stack developer specializing in building scalable web applications, API architectures, and cloud deployments.',
                'primary_btn' => 'View My Work',
                'primary_url' => '/projects',
                'secondary_btn' => 'Let\'s Work Together',
                'secondary_url' => '/contact',
                'availability' => 'Available for work',
                'code_editor' => "import React from 'react';\nconst developer = {\n  name: 'Amiri Bajuun',\n  role: 'Full Stack Engineer',\n};\nfunction build() { return pipeline.optimize().secure(); }",
            ]),
            'sections' => Setting::get('homepage.sections', [
                ['key' => 'hero', 'name' => 'Hero', 'enabled' => true],
                ['key' => 'technology_stack', 'name' => 'Technology Stack', 'enabled' => true],
                ['key' => 'featured_projects', 'name' => 'Featured Projects', 'enabled' => true],
                ['key' => 'about', 'name' => 'About', 'enabled' => true],
                ['key' => 'statistics', 'name' => 'Statistics', 'enabled' => true],
                ['key' => 'services', 'name' => 'Services', 'enabled' => true],
                ['key' => 'experience', 'name' => 'Experience', 'enabled' => true],
                ['key' => 'testimonials', 'name' => 'Testimonials', 'enabled' => true],
                ['key' => 'cta', 'name' => 'CTA', 'enabled' => true],
            ]),
        ]);
    }

    public function update(Request $request)
    {
        $hero = $request->validate([
            'eyebrow' => 'nullable|string',
            'heading' => 'required|string',
            'description' => 'nullable|string',
            'primary_btn' => 'nullable|string',
            'primary_url' => 'nullable|string',
            'secondary_btn' => 'nullable|string',
            'secondary_url' => 'nullable|string',
            'availability' => 'nullable|string',
            'code_editor' => 'nullable|string',
        ]);

        Setting::set('homepage.hero', $hero);

        $enabled = $request->input('sections_enabled', []);
        $order = $request->input('sections_order', []);

        $defaults = [
            ['key' => 'hero', 'name' => 'Hero'],
            ['key' => 'technology_stack', 'name' => 'Technology Stack'],
            ['key' => 'featured_projects', 'name' => 'Featured Projects'],
            ['key' => 'about', 'name' => 'About'],
            ['key' => 'statistics', 'name' => 'Statistics'],
            ['key' => 'services', 'name' => 'Services'],
            ['key' => 'experience', 'name' => 'Experience'],
            ['key' => 'testimonials', 'name' => 'Testimonials'],
            ['key' => 'cta', 'name' => 'CTA'],
        ];

        $ordered = collect($defaults)->sortBy(fn ($d) => array_search($d['key'], $order) !== false ? array_search($d['key'], $order) : 999)->values();

        $sections = $ordered->map(fn ($d) => [
            'key' => $d['key'],
            'name' => $d['name'],
            'enabled' => in_array($d['key'], $enabled, true),
        ])->all();

        Setting::set('homepage.sections', $sections);

        return back()->with('status', 'Homepage updated successfully.');
    }
}
