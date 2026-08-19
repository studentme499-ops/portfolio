<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:255',
            'avatar' => 'nullable|string',
        ]);

        if ($request->hasFile('avatar_file')) {
            $path = $request->file('avatar_file')->store('avatars', 'public');
            $validated['avatar'] = 'storage/'.$path;
        }

        $user->update($validated);

        return back()->with('status', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('status', 'Password updated successfully.');
    }

    public function toggle2fa()
    {
        $user = Auth::user();
        $user->update(['two_factor_enabled' => ! $user->two_factor_enabled]);

        return back()->with('status', 'Two-factor authentication '.($user->two_factor_enabled ? 'enabled' : 'disabled').'.');
    }
}