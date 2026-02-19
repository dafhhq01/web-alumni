<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) return redirect()->route('login');

        $userRole = $request->user()->role;

        // Super Admin adalah "Tuhan" di aplikasi, izinkan akses ke mana saja
        if ($userRole === 'super-admin') {
            return $next($request);
        }

        if ($userRole !== $role) {
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            // Alumni yang belum verifikasi/selesai profil tetap ke sini
            return redirect()->route('alumni.profile');
        }

        return $next($request);
    }
}
