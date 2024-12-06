<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::user() || Auth::user()->role !== $role) {
            return redirect('/');  // Redirect jika user tidak memiliki role yang diinginkan
        }
        return $next($request);
    }
}
