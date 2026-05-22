<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     * Redirect unauthenticated users trying to access admin routes to the login page.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin*') && !$request->is('admin/login')) {
            if (!auth()->check() || !auth()->user()->is_admin) {
                return redirect()->route('admin.login');
            }
        }

        return $next($request);
    }
}
