<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeaknessDetectionService;
use Illuminate\Support\Facades\Auth;

class InsightController extends Controller
{
    public function index(WeaknessDetectionService $engine)
    {
        $user = Auth::user();
        $result = $engine->detect($user->id);

        $weakest = $result['weakest_category'] ?? null;
        $hasEvaluated = !empty($result['scores']);

        // Jika user belum evaluasi, kembalikan ke dashboard dengan pesan
        if (!$hasEvaluated) {
            return redirect()->route('dashboard')->with('status', 'Silakan lakukan evaluasi terlebih dahulu untuk melihat Business Insights.');
        }

        $problem = $engine->biggestProblem($weakest);
        $actionSteps = $engine->detailedActionPlan($weakest);

        return view('insights.index', compact('weakest', 'problem', 'actionSteps'));
    }
}
