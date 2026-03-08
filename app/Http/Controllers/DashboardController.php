<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeaknessDetectionService;

class DashboardController extends Controller
{
    public function index(WeaknessDetectionService $engine)
    {
        $user = auth()->user();
        
        $result = $engine->detect($user->id);
        
        $scores = $result['scores'] ?? [];
        $weakest = $result['weakest_category'] ?? null;
        
        $problem = $engine->biggestProblem($weakest);
        $recommendation = $engine->recommendation($weakest);
        
        $healthScore = 0;
        if(count($scores) > 0){
            $avg = array_sum($scores) / count($scores);
            $healthScore = round(($avg / 5) * 100);
        }
        
        return view('dashboard', [
            'scores' => $scores,
            'weakestCategory' => $weakest,
            'problem' => $problem,
            'recommendation' => $recommendation,
            'healthScore' => $healthScore
        ]);
    }
}