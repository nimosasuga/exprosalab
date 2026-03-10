<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Evaluation;
use App\Models\EvaluationAnswer;
use App\Models\EvaluationCategory;
use App\Services\EvaluationService;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    protected $evaluationService;

    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    /**
     * Menampilkan halaman utama Business Evaluation & Riwayat
     */
    public function index()
    {
        // Cari profil bisnis milik user yang sedang login
        $business = Business::where('user_id', Auth::id())->first();

        // Jika user belum punya profil bisnis, kirimkan daftar riwayat kosong
        if (!$business) {
            $evaluations = collect(); // Membuat himpunan kosong (agar tidak error di view)
        } else {
            // Jika punya, ambil semua riwayat evaluasinya dari yang paling baru
            $evaluations = Evaluation::where('business_id', $business->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('evaluation', compact('evaluations'));
    }

    /**
     * Memulai wizard dan membuat draft evaluasi
     */
    public function initWizard()
    {
        // Cari profil bisnis
        $business = Business::where('user_id', Auth::id())->first();

        // Jika user tidak punya profil bisnis (misal user lama), arahkan ke halaman edit profil
        if (!$business || empty($business->business_name)) {
            return redirect()->route('profile.edit')->with('status', 'Silakan lengkapi nama bisnis Anda terlebih dahulu sebelum memulai evaluasi.');
        }

        // Cek apakah ada draft yang belum selesai
        $evaluation = Evaluation::firstOrCreate(
            ['business_id' => $business->id, 'status' => 'draft'],
            ['current_step' => 1, 'total_score' => 0, 'business_health' => 'Unknown']
        );

        return redirect()->route('evaluation.step', ['step' => $evaluation->current_step]);
    }

    /**
     * Menampilkan pertanyaan per kategori (Step)
     */
    public function showStep($step)
    {
        $business = Business::where('user_id', Auth::id())->first();
        $evaluation = Evaluation::where('business_id', $business->id)->where('status', 'draft')->firstOrFail();

        // Ambil kategori berdasarkan urutan step (1 = Market, 2 = Visibility, dll)
        $category = EvaluationCategory::with('questions')->orderBy('id')->skip($step - 1)->first();

        if (!$category) {
            // Jika kategori habis, proses kalkulasi akhir
            return $this->finishEvaluation($evaluation);
        }

        $totalCategories = EvaluationCategory::count();
        $progress = ($step / $totalCategories) * 100;

        return view('evaluation.wizard', compact('category', 'step', 'totalCategories', 'progress', 'evaluation'));
    }

    /**
     * Menyimpan jawaban sementara per step
     */
    public function saveStep(Request $request, $step)
    {
        $evaluation = Evaluation::findOrFail($request->evaluation_id);

        // Simpan setiap jawaban
        foreach ($request->answers as $questionId => $score) {
            EvaluationAnswer::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'question_id' => $questionId,
                    'evaluation_id' => $evaluation->id
                ],
                ['score' => (int) $score]
            );
        }

        // Lanjut ke step berikutnya
        $nextStep = $step + 1;
        $evaluation->update(['current_step' => $nextStep]);

        return redirect()->route('evaluation.step', ['step' => $nextStep]);
    }

    /**
     * Menyelesaikan evaluasi dan menghitung skor
     */
    private function finishEvaluation(Evaluation $evaluation)
    {
        $answers = EvaluationAnswer::with('question.category')
            ->where('evaluation_id', $evaluation->id)
            ->get();

        $scores = [];
        $totalScore = 0;

        foreach ($answers as $answer) {
            // Pastikan tidak error jika relasi kosong
            if ($answer->question && $answer->question->category) {
                $categoryCode = $answer->question->category->code;
                if (!isset($scores[$categoryCode])) {
                    $scores[$categoryCode] = 0;
                }
                $scores[$categoryCode] += $answer->score;
                $totalScore += $answer->score;
            }
        }

        // Panggil Service untuk kalkulasi kesehatan akhir
        $healthStatus = $this->evaluationService->determineHealthStatus($totalScore);

        $evaluation->update([
            'total_score' => $totalScore,
            'business_health' => $healthStatus,
            'status' => 'completed'
        ]);

        return redirect()->route('evaluation.result', ['id' => $evaluation->id]);
    }

    /**
     * Menampilkan hasil diagnosis, skor per kategori, dan saran strategis.
     */
    public function result($id)
    {
        $evaluation = Evaluation::findOrFail($id);

        $answers = EvaluationAnswer::with('question.category')
            ->where('evaluation_id', $evaluation->id)
            ->get();

        // Inisialisasi 5 pilar sistem bisnis yang baru
        $scores = [
            'market' => 0,
            'visibility' => 0,
            'conversion' => 0,
            'monetization' => 0,
            'system' => 0
        ];

        // Hitung total skor per kategori
        foreach ($answers as $answer) {
            if ($answer->question && $answer->question->category) {
                $categoryCode = $answer->question->category->code;
                if (isset($scores[$categoryCode])) {
                    $scores[$categoryCode] += $answer->score;
                }
            }
        }

        // Panggil Service untuk menghasilkan diagnosis
        $diagnosis = $this->evaluationService->generateDiagnosis($scores);

        return view('evaluation.result', compact('evaluation', 'scores', 'diagnosis'));
    }

    /**
     * Menangani klik menu "Evaluation Results" dari Sidebar
     */
    public function indexResults()
    {
        $business = Business::where('user_id', Auth::id())->first();

        if (!$business) {
            return redirect()->route('dashboard');
        }

        // Cari evaluasi terakhir yang sudah selesai
        $latestEvaluation = Evaluation::where('business_id', $business->id)
            ->where('status', 'completed')
            ->latest()
            ->first();

        if (!$latestEvaluation) {
            // Jika belum ada yang selesai, arahkan kembali ke dashboard
            return redirect()->route('dashboard')->with('status', 'Anda belum memiliki hasil evaluasi yang selesai.');
        }

        // Jika ada, langsung arahkan ke halaman hasil yang sesuai
        return redirect()->route('evaluation.result', ['id' => $latestEvaluation->id]);
    }
    /**
     * Menghapus riwayat evaluasi
     */
    public function destroy(Request $request, $id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $business = Business::where('user_id', Auth::id())->first();

        // Keamanan: Pastikan evaluasi ini benar-benar milik bisnis user yang sedang login
        if (!$business || $evaluation->business_id !== $business->id) {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus riwayat ini.');
        }

        // Hapus evaluasi (jawaban yang terkait juga akan otomatis terhapus jika Anda menggunakan cascade di database)
        $evaluation->delete();

        return back()->with('success', 'Riwayat evaluasi berhasil dihapus!');
    }
}
