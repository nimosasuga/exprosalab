<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth()->user();

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

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}