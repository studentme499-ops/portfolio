<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactSettingsController extends Controller
{
    public function edit()
    {
        return view('admin.contact-settings', [
            'contact' => Setting::get('contact', [
                'email' => 'amiribajuun992@gmail.com',
                'phone' => '+255 700 000 000',
                'location' => 'Dar es Salaam, Tanzania',
                'whatsapp' => '',
                'available' => true,
                'availability_message' => 'Currently available for freelance work.',
                'notification_email' => 'amiribajuun992@gmail.com',
                'auto_reply' => 'Thank you for contacting me. I\'ll get back to you within 24 hours.',
                'success_message' => 'Your message has been sent successfully.',
            ]),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'available' => 'nullable|boolean',
            'availability_message' => 'nullable|string',
            'notification_email' => 'nullable|email',
            'auto_reply' => 'nullable|string',
            'success_message' => 'nullable|string',
        ]);

        $validated['available'] = $request->boolean('available');

        Setting::set('contact', $validated);

        return back()->with('status', 'Contact settings updated.');
    }
}