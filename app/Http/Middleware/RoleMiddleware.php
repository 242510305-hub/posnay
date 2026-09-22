<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // cek login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        /**
         * AMBIL ROLE USER
         * - jika pakai kolom langsung: users.role = "admin"
         * - jika pakai relasi: users -> role -> name
         */
        $userRole = $request->user()->role?->name 
                    ?? $request->user()->role;

        // cek apakah role diizinkan
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}