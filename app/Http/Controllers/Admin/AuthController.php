<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an admin login attempt.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials, $request->boolean('remember'))) {
            if (!auth()->user()->is_admin) {
                auth()->logout();
                return back()->withErrors(['email' => '您没有管理员权限。'])->withInput();
            }
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => '邮箱或密码不正确。'])->withInput();
    }

    /**
     * Log the admin out.
     */
    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
