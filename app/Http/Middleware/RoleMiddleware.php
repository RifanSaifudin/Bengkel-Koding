<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  // Tambahkan parameter role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (auth()->user()->role !== $role) {
            // Jika tidak sesuai, tampilkan pesan yang lebih jelas
            abort(403, 'Kamu tidak memiliki akses ke halaman ini.');
        }
    
        // // return $next($request);
        // if (!in_array(auth()->user()->role, $roles)) {
        //     abort(403, 'Kamu tidak memiliki akses ke halaman ini.');
        // }

        return $next($request);
    }
}