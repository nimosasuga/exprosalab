<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Memberi tahu editor bahwa $user ini adalah model User
        /** @var \App\Models\User $user */
        $user = $request->user();

        if (!$user) {
            return redirect('/login');
        }

        // ambil nama role
        $userRole = null;

        if (is_object($user->role)) {
            $userRole = $user->role->name;
        } else {
            $userRole = $user->role;
        }

        // admin selalu boleh
        if ($userRole === 'admin') {
            return $next($request);
        }

        // Jika rolenya sesuai dengan yang diizinkan route
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // 2. JIKA BUKAN PREMIUM & MENCOBA AKSES HALAMAN PREMIUM -> ARAHKAN KE SUBSCRIPTION
        if (in_array('premium', $roles)) {
            return redirect()->route('subscription.index')->with('error', 'Fitur ini khusus untuk member Pro. Yuk, upgrade sekarang!');
        }

        // Jika mencoba mengakses halaman lain yang tidak berhak, kembalikan ke dashboard
        return redirect('/dashboard');
    }
}
