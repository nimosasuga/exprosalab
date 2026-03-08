<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeaknessDetectionService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(WeaknessDetectionService $engine)
    {
        $user = Auth::user();

        $result = $engine->detect($user->id);

        $scores = $result['scores'] ?? [];
        $weakest = $result['weakest_category'] ?? null;

        $problem = $engine->biggestProblem($weakest);
        $recommendation = $engine->recommendation($weakest);

        $totalScore = $result['total_score'] ?? 0;
        $healthStatus = $result['health_status'] ?? 'Belum Evaluasi';

        // Hitung Health Score dalam Persentase (Maksimal skor 250)
        $healthPercentage = 0;
        if ($totalScore > 0) {
            $healthPercentage = round(($totalScore / 250) * 100);
        }

        $hasEvaluated = !empty($scores);

        return view('dashboard', compact(
            'scores',
            'weakest',
            'problem',
            'recommendation',
            'healthPercentage',
            'healthStatus',
            'hasEvaluated'
        ));
    }
}
