<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PremiumMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
    
        if (!$user) {
            return redirect('/login');
        }
    
        // ADMIN selalu boleh akses
        if ($user->isAdmin()) {
            return $next($request);
        }
    
        // jika bukan admin → harus punya subscription aktif
        if (!$user->hasActiveSubscription()) {
            return redirect('/dashboard');
        }
    
        return $next($request);
    }
}