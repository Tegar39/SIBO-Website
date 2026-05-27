<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolePAC
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $anggota = $user->anggota;

        if ($user->role !== 'pac' && ! ($user->role === 'anggota' && $anggota && filled($anggota->pac))) {
            abort(403, 'Hanya pengurus PAC/anggota yang memiliki data PAC yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}
