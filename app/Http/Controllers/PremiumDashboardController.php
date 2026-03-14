<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use App\Models\Evaluation;
use App\Models\Business;
use App\Services\WeaknessDetectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremiumDashboardController extends Controller
{
    protected $weaknessService;

    public function __construct(WeaknessDetectionService $weaknessService)
    {
        $this->weaknessService = $weaknessService;
    }

    public function index(Request $request)
    {
        $user     = Auth::user();
        $business = Business::where('user_id', $user->id)->first();

        if (!$business) {
            return view('premium.dashboard', [
                'actionPlans'          => collect(),
                'progress'             => 0,
                'histories'            => collect(),
                'selectedEvaluationId' => null,
                'chartLabels'          => [],
                'chartScores'          => [],
                'showChart'            => false, // Tambahkan ini
                'showOneTip'           => false, // Tambahkan ini
            ]);
        }

        // Ambil riwayat untuk dropdown (terbaru di atas)
        $histories = Evaluation::where('business_id', $business->id)
            ->where('status', 'completed')
            ->latest()
            ->get();

        // Ambil riwayat untuk Chart (kronologis: terlama → terbaru)
        $chartEvaluations = Evaluation::where('business_id', $business->id)
            ->where('status', 'completed')
            ->orderBy('created_at', 'asc')
            ->get();

        $chartLabels = [];
        $chartScores = [];

        foreach ($chartEvaluations as $ev) {
            $chartLabels[] = $ev->created_at->format('d M Y');
            $chartScores[] = (int) $ev->total_score;
        }

        // --- PINDAHKAN LOGIKA DARI BLADE KE SINI ---
        $chartCount = count($chartLabels);
        $showChart  = $chartCount >= 2;
        $showOneTip = $chartCount === 1;

        // Tentukan ID evaluasi yang sedang dilihat (query string atau terbaru)
        $selectedEvaluationId = $request->query('evaluation_id', $histories->first()?->id);

        // Ambil Action Plan berdasarkan evaluasi yang dipilih
        $actionPlans = ActionPlan::where('user_id', $user->id)
            ->where('evaluation_id', $selectedEvaluationId)
            ->latest()
            ->get();

        // Generate action plan otomatis jika belum ada
        if ($actionPlans->isEmpty() && $selectedEvaluationId) {
            $this->generateActionPlansFromEvaluation($user->id, $selectedEvaluationId);
            $actionPlans = ActionPlan::where('user_id', $user->id)
                ->where('evaluation_id', $selectedEvaluationId)
                ->latest()
                ->get();
        }

        $completedCount = $actionPlans->where('status', 'completed')->count();
        $totalCount     = $actionPlans->count();
        $progress       = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0;

        // Tambahkan variabel baru ke dalam compact()
        return view('premium.dashboard', compact(
            'actionPlans',
            'progress',
            'histories',
            'selectedEvaluationId',
            'chartLabels',
            'chartScores',
            'showChart',
            'showOneTip'
        ));
    }

    public function updateTask(Request $request, $id)
    {
        $task = ActionPlan::where('user_id', Auth::id())->findOrFail($id);

        // Tentukan apakah task ini sedang ditandai selesai atau batal
        $isCompleting = $task->status === 'pending';

        // Toggle status action plan
        $task->status = $isCompleting ? 'completed' : 'pending';
        $task->save();

        // --- LOGIKA UPDATE SKOR EVALUASI UNTUK GRAFIK ---
        $evaluation = Evaluation::find($task->evaluation_id);

        if ($evaluation) {
            // Tentukan berapa poin kenaikan skor untuk setiap tugas yang diselesaikan.
            // Anda bisa menyesuaikan angka ini (misal: 5 poin per task)
            $pointsPerTask = 5;

            if ($isCompleting) {
                $evaluation->total_score += $pointsPerTask;
            } else {
                $evaluation->total_score -= $pointsPerTask;
            }

            // Pastikan skor tetap aman: Tidak kurang dari 0 dan tidak lebih dari 250 (skor maksimal)
            $evaluation->total_score = max(0, min(250, $evaluation->total_score));

            $evaluation->save();
        }

        return redirect()->back();
    }

    /**
     * Generate Action Plans berdasarkan evaluasi spesifik
     */
    private function generateActionPlansFromEvaluation($userId, $evaluationId)
    {
        $analysis        = $this->weaknessService->detect($userId, $evaluationId);
        $weakestCategory = $analysis['weakest_category'] ?? null;

        if (!$weakestCategory) {
            return;
        }

        $recommendations = $this->weaknessService->detailedActionPlan($weakestCategory);

        $categoryNames = [
            'market'       => 'Product-Market Fit',
            'visibility'   => 'Marketing & Traffic',
            'conversion'   => 'Sales & Conversion',
            'monetization' => 'Finance & Monetization',
            'system'       => 'System & Operations',
        ];

        $readableCategory = $categoryNames[$weakestCategory] ?? 'General Strategy';

        foreach ($recommendations as $rec) {
            ActionPlan::create([
                'user_id'       => $userId,
                'evaluation_id' => (int) $evaluationId,
                'category'      => $readableCategory,
                'title'         => $rec['title'],
                'description'   => $rec['desc'],
                'status'        => 'pending',
            ]);
        }
    }
}
