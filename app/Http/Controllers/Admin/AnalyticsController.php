<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        // 1. Menghitung Total User (Bisa dikurangi 1 jika tidak ingin menghitung akun God Mode/Admin itu sendiri)
        $totalUsers = User::count();

        // 2. Menghitung User Free & Premium
        // Asumsi: Anda memiliki relasi 'role' di model User dan field 'name' di tabel roles.
        $freeUsers = User::whereHas('role', function ($query) {
            $query->where('name', 'free');
        })->count();

        $premiumUsers = User::whereHas('role', function ($query) {
            $query->where('name', 'premium');
        })->count();

        // Menghitung persentase untuk rasio (mencegah error division by zero)
        $premiumRatio = $totalUsers > 0 ? round(($premiumUsers / $totalUsers) * 100, 1) : 0;
        $freeRatio = $totalUsers > 0 ? round(($freeUsers / $totalUsers) * 100, 1) : 0;

        // 3. Menghitung Rata-rata Skor Evaluasi
        // Asumsi: Di tabel 'evaluations' ada kolom 'total_score' atau 'score'. Sesuaikan jika namanya berbeda!
        $averageScore = Evaluation::avg('total_score') ?? 0;
        $totalEvaluations = Evaluation::count();

        // Mengirim data ke View
        return view('admin.analytics', compact(
            'totalUsers',
            'freeUsers',
            'premiumUsers',
            'premiumRatio',
            'freeRatio',
            'averageScore',
            'totalEvaluations'
        ));
    }
}
