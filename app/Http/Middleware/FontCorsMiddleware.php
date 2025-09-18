<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FontCorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if the request is for a font file
        $path = $request->getPathInfo();
        $fontExtensions = ['woff', 'woff2', 'ttf', 'otf', 'eot'];

        foreach ($fontExtensions as $extension) {
            if (str_ends_with($path, '.' . $extension)) {
                $response->headers->set('Access-Control-Allow-Origin', '*');
                $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
                $response->headers->set('Access-Control-Allow-Headers', 'Content-Type');
                $response->headers->set('Cache-Control', 'public, max-age=31536000');
                break;
            }
        }

        return $response;
    }
}
