<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InjectJwtFromCookie
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->cookies->has('access_token')) {
            $token = $request->cookie('access_token');
            // thêm header để jwt-auth đọc
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }
        return $next($request);
    }
}
