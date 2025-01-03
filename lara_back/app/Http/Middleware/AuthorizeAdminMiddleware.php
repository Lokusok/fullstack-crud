<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');

        if ($token !== '123') {
            abort(403);
        }

        return $next($request);
    }
}
