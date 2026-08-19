<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SecurityController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('admin.security', ['user' => $user]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return back()->with('status', 'Password changed successfully.');
    }

    public function toggle2fa(Request $request)
    {
        Auth::user()->update([
            'two_factor_enabled' => $request->boolean('enabled'),
        ]);

        return back()->with('status', $request->boolean('enabled')
            ? 'Two-factor authentication enabled.'
            : 'Two-factor authentication disabled.');
    }

    public function revokeSessions(Request $request)
    {
        Auth::logoutOtherDevices($request->password);

        return back()->with('status', 'Other active sessions revoked.');
    }
}