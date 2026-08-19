<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit()
    {
        return view('admin.about', [
            'about' => Setting::get('about', [
                'title' => 'Architecting For Scalability',
                'description' => 'I specialize in bridging the gap between elegant visual interfaces and enterprise-grade backend infrastructure.',
                'bio' => 'Amiri Bajuun is a full stack developer with over 5+ years of experience building scalable web applications.',
                'learn_more_text' => 'Learn More About My Story',
                'learn_more_url' => '/about',
                'profile_image' => '',
            ]),
            'stats' => Setting::get('about.stats', [
                ['value' => '5+', 'label' => 'Years Experience'],
                ['value' => '50+', 'label' => 'Projects Completed'],
                ['value' => '30+', 'label' => 'Happy Clients'],
            ]),
        ]);
    }

    public function update(Request $request)
    {
        $about = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'bio' => 'nullable|string',
            'learn_more_text' => 'nullable|string',
            'learn_more_url' => 'nullable|string',
            'profile_image' => 'nullable|string',
        ]);

        Setting::set('about', $about);

        $stats = [];
        $values = $request->input('stat_value', []);
        $labels = $request->input('stat_label', []);

        foreach ($values as $i => $value) {
            if ($value !== null || ! empty($labels[$i])) {
                $stats[] = [
                    'value' => $value,
                    'label' => $labels[$i] ?? '',
                ];
            }
        }

        Setting::set('about.stats', $stats);

        return back()->with('status', 'About section updated successfully.');
    }
}
