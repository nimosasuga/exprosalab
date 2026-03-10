<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PremiumMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan memiliki status langganan aktif ATAU role premium
        if ($request->user() && ($request->user()->hasActiveSubscription() || $request->user()->isPremium())) {
            return $next($request); // Silakan masuk
        }

        // Jika bukan premium, arahkan ke halaman penawaran langganan (nanti kita buat view-nya)
        // Anda bisa mengganti 'subscription.index' dengan nama route halaman harga Anda nanti
        return redirect()->route('dashboard')->with('error', 'Halaman Business Insights hanya untuk member Pro. Yuk, upgrade akun Anda!');
    }
}
