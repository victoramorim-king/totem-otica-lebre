<?php
// Arquivo: app/Http/Middleware/ContentSecurityPolicy.php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Adicione a diretiva media-src ao CSP
        $response->headers->set('Content-Security-Policy', "media-src 'self' blob: data:");

        return $response;
    }
}

