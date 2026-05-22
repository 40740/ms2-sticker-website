<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Add security headers to every response.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Prevent MIME-type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Control referrer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Disable unnecessary browser features
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // XSS protection (legacy, mainly for older browsers)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}
