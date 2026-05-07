<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolePAC
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role !== 'pac') {
            abort(403, 'Hanya PAC yang dapat mengakses halaman ini.');
        }
        return $next($request);
    }
}
