<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeaknessDetectionService;
use App\Models\Business;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;

class InsightController extends Controller
{
    // Tambahkan Request dan parameter $id = null
    public function index(Request $request, WeaknessDetectionService $engine, $id = null)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        // Teruskan $id tersebut ke dalam engine pencari kelemahan
        $result = $engine->detect($user->id, $id);

        $weakest = $result['weakest_category'] ?? null;
        $hasEvaluated = !empty($result['scores']);

        if (!$hasEvaluated) {
            return redirect()->route('dashboard')->with('status', 'Silakan lakukan evaluasi terlebih dahulu untuk melihat Business Insights.');
        }

        $problem = $engine->biggestProblem($weakest);
        $actionSteps = $engine->detailedActionPlan($weakest);

        // Ambil data evaluasi spesifik yang saat ini sedang dibaca
        $currentEvaluation = $result['evaluation'] ?? null;

        // Ambil seluruh daftar riwayat evaluasi untuk menu Dropdown
        $business = Business::where('user_id', $user->id)->first();
        $histories = Evaluation::where('business_id', $business->id)
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('insights.index', compact('weakest', 'problem', 'actionSteps', 'histories', 'currentEvaluation'));
    }
}
