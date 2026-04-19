<?php

namespace App\Http\Controllers\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticatedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route('admin.login');
        }

        $adminEmail = env('ADMIN_EMAIL', 'admin@dugunsalonu.com');

        if ((string) Auth::user()?->email !== (string) $adminEmail) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}

