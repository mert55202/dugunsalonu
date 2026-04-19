<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(): \Illuminate\Contracts\View\View
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $rememberAdmin = false;

        if (! Auth::attempt($validated, $rememberAdmin)) {
            return back()->withErrors(['email' => 'E-posta veya sifre hatali.'])->withInput();
        }

        $adminEmail = env('ADMIN_EMAIL', 'admin@dugunsalonu.com');
        if ((string) Auth::user()?->email !== (string) $adminEmail) {
            Auth::logout();

            return back()->withErrors(['email' => 'Yetkiniz yok.'])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}

