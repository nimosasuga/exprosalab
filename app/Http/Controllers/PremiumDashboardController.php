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
        $user = Auth::user();
        $business = Business::where('user_id', $user->id)->first();

        if (!$business) {
            return view('premium.dashboard', [
                'actionPlans' => collect(),
                'progress' => 0,
                'histories' => collect(),
                'selectedEvaluationId' => null,
            ]);
        }

        // Ambil semua riwayat evaluasi yang sudah selesai untuk dropdown
        $histories = Evaluation::where('business_id', $business->id)
            ->where('status', 'completed')
            ->latest()
            ->get();

        // Tentukan ID evaluasi yang sedang dilihat (dari query string atau yang terbaru)
        $selectedEvaluationId = $request->query('evaluation_id', $histories->first()?->id);

        // Ambil Action Plan berdasarkan evaluasi yang dipilih
        $actionPlans = ActionPlan::where('user_id', $user->id)
            ->where('evaluation_id', $selectedEvaluationId)
            ->latest()
            ->get();

        // Jika Action Plan belum ada untuk evaluasi ini, buatkan secara otomatis
        if ($actionPlans->isEmpty() && $selectedEvaluationId) {
            $this->generateActionPlansFromEvaluation($user->id, $selectedEvaluationId);
            $actionPlans = ActionPlan::where('user_id', $user->id)
                ->where('evaluation_id', $selectedEvaluationId)
                ->latest()
                ->get();
        }

        $completedCount = $actionPlans->where('status', 'completed')->count();
        $totalCount = $actionPlans->count();
        $progress = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0;

        return view('premium.dashboard', compact(
            'actionPlans',
            'progress',
            'histories',
            'selectedEvaluationId'
        ));
    }

    public function updateTask(Request $request, $id)
    {
        $task = ActionPlan::where('user_id', Auth::id())->findOrFail($id);

        // Toggle status
        $task->status = $task->status === 'pending' ? 'completed' : 'pending';
        $task->save();

        // Kembali ke halaman dengan evaluation_id yang sama agar tidak kehilangan konteks
        return redirect()->back();
    }

    /**
     * Generate Action Plans berdasarkan evaluasi spesifik
     */
    private function generateActionPlansFromEvaluation($userId, $evaluationId)
    {
        // Gunakan service untuk deteksi kelemahan berdasarkan ID evaluasi spesifik
        $analysis = $this->weaknessService->detect($userId, $evaluationId);
        $weakestCategory = $analysis['weakest_category'];

        // Jika tidak ada data kelemahan (user belum evaluasi), hentikan
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
                'evaluation_id' => $evaluationId,
                'category'      => $readableCategory,
                'title'         => $rec['title'],
                'description'   => $rec['desc'],
                'status'        => 'pending',
            ]);
        }
    }
}
