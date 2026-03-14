<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use App\Services\WeaknessDetectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremiumDashboardController extends Controller
{
    protected $weaknessService;

    // Melakukan injeksi WeaknessDetectionService
    public function __construct(WeaknessDetectionService $weaknessService)
    {
        $this->weaknessService = $weaknessService;
    }

    public function index()
    {
        $user = Auth::user();

        // Mengambil daftar Action Plan milik user
        $actionPlans = ActionPlan::where('user_id', $user->id)->latest()->get();

        // Jika user belum punya action plan sama sekali, buatkan dari hasil evaluasinya
        if ($actionPlans->isEmpty()) {
            $this->generateInitialActionPlans($user->id);
            // Ambil ulang data setelah di-generate
            $actionPlans = ActionPlan::where('user_id', $user->id)->latest()->get();
        }

        $completedCount = $actionPlans->where('status', 'completed')->count();
        $totalCount = $actionPlans->count();
        $progress = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0;

        return view('premium.dashboard', compact('actionPlans', 'progress'));
    }

    public function updateTask(Request $request, $id)
    {
        $task = ActionPlan::where('user_id', Auth::id())->findOrFail($id);

        // Toggle status
        $task->status = $task->status === 'pending' ? 'completed' : 'pending';
        $task->save();

        return redirect()->back();
    }

    // Fungsi cerdas untuk membuat tugas awal berdasarkan pilar terlemah
    private function generateInitialActionPlans($userId)
    {
        // 1. Dapatkan hasil deteksi kelemahan user menggunakan algoritma Anda
        $analysis = $this->weaknessService->detect($userId);
        $weakestCategory = $analysis['weakest_category'];

        // Jika tidak ada data kelemahan (berarti user belum evaluasi), hentikan pembuatan tugas
        if (!$weakestCategory) {
            return;
        }

        // 2. Ambil rancangan tugas spesifik dari WeaknessDetectionService
        $recommendations = $this->weaknessService->detailedActionPlan($weakestCategory);

        // 3. Mapping kode kategori menjadi nama yang elegan untuk UI
        $categoryNames = [
            'market' => 'Product-Market Fit',
            'visibility' => 'Marketing & Traffic',
            'conversion' => 'Sales & Conversion',
            'monetization' => 'Finance & Monetization',
            'system' => 'System & Operations'
        ];

        $readableCategory = $categoryNames[$weakestCategory] ?? 'General Strategy';

        // 4. Masukkan rencana tindakan ke dalam database user
        foreach ($recommendations as $rec) {
            ActionPlan::create([
                'user_id' => $userId,
                'category' => $readableCategory,
                'title' => $rec['title'],
                // Di dalam file service Anda, key deskripsinya adalah 'desc', bukan 'description'
                'description' => $rec['desc'],
                'status' => 'pending'
            ]);
        }
    }
}
