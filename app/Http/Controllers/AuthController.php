<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (! $user->is_active) {
                Auth::logout();

                return back()->withErrors(['email' => 'This account has been deactivated.']);
            }

            $user->update(['last_login_at' => now()]);

            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'Login',
                'entity_type' => 'auth',
                'description' => 'Admin login',
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 200),
            ]);

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'Logout',
                'entity_type' => 'auth',
                'description' => 'Admin logout',
                'ip_address' => $request->ip(),
            ]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    // Forgot / reset password
    public function showForgot()
    {
        return view('admin.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showReset(Request $request)
    {
        return view('admin.reset-password', ['token' => $request->token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Verify email & 2FA stubs (full 2FA via TOTP would need a package)
    public function showVerifyEmail()
    {
        return view('admin.verify-email');
    }

    public function show2fa()
    {
        return view('admin.2fa');
    }

    public function verify2fa(Request $request)
    {
        // Placeholder for TOTP verification
        return redirect()->route('admin.dashboard')->with('status', 'Signed in.');
    }
}
