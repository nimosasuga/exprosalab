<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Evaluation;
use App\Models\EvaluationAnswer;
use App\Models\EvaluationCategory;
use App\Services\EvaluationService;
use Illuminate\Support\Facades\Auth; // Tambahkan import Facade Auth ini

class EvaluationController extends Controller
{
    protected $evaluationService;

    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    /**
     * Memulai wizard dan membuat draft evaluasi
     */
    public function initWizard()
    {
        // Gunakan Auth::id() dan Auth::user() agar Intelephense tidak protes
        $business = Business::firstOrCreate(
            ['user_id' => Auth::id()],
            ['business_name' => 'Bisnis ' . Auth::user()->name]
        );

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
                    'user_id' => Auth::id(), // Gunakan Auth::id() di sini juga
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
}
