<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Evaluation;
use App\Models\EvaluationAnswer;
use App\Models\EvaluationQuestion;
use App\Models\EvaluationCategory;

class EvaluationController extends Controller
{
    /**
     * Menampilkan daftar pertanyaan berdasarkan kategori.
     */
    public function start()
    {
        $categories = EvaluationCategory::with('questions')->get();
        return view('evaluation.start', compact('categories'));
    }

    /**
     * Menyimpan hasil evaluasi ke database secara dinamis.
     */
    public function store(Request $request)
    {
        $business = Business::where('user_id', auth()->id())->first();

        if (!$business) {
            return redirect()->back()->with('error', 'Bisnis tidak ditemukan. Silakan buat profil bisnis terlebih dahulu.');
        }

        $evaluation = Evaluation::create([
            'business_id' => $business->id
        ]);

        $totalScore = 0;
        foreach ($request->answers as $questionId => $score) {
            EvaluationAnswer::create([
                'user_id' => auth()->id(),
                'question_id' => $questionId,
                'score' => (int) $score
            ]);
            $totalScore += $score;
        }

        $evaluation->total_score = $totalScore;
        $evaluation->business_health = $this->calculateHealth($totalScore);
        $evaluation->save();

        return redirect('/evaluation/result/' . $evaluation->id);
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

        $scores = [
            'market' => 0,
            'product' => 0,
            'marketing' => 0,
            'operation' => 0,
            'finance' => 0
        ];

        foreach ($answers as $answer) {
            $category = $answer->question->category->code;
            if (isset($scores[$category])) {
                $scores[$category] += $answer->score;
            }
        }

        // Panggil generator diagnosis berdasarkan skor yang dihitung
        $diagnosis = $this->generateDiagnosis($scores);

        return view('evaluation.result', [
            'evaluation' => $evaluation,
            'scores' => $scores,
            'diagnosis' => $diagnosis
        ]);
    }

    /**
     * Logika penentuan status kesehatan berdasarkan Framework Exprosa.
     */
    private function calculateHealth($score)
    {
        if ($score <= 80) return 'Critical';
        if ($score <= 130) return 'Weak';
        if ($score <= 180) return 'Stable';
        return 'Strong';
    }

    /**
     * Menghasilkan daftar rekomendasi strategis berdasarkan skor kategori.
     */
    private function generateDiagnosis($scores)
    {
        $diagnosis = [];

        if ($scores['marketing'] < 25) {
            $diagnosis[] = "Marketing system lemah. Bisnis belum memiliki sistem akuisisi pelanggan yang konsisten.";
        }

        if ($scores['market'] < 25) {
            $diagnosis[] = "Market validation rendah. Produk mungkin belum menemukan market fit yang jelas.";
        }

        if ($scores['product'] < 25) {
            $diagnosis[] = "Produk belum cukup kuat dibanding kompetitor.";
        }

        if ($scores['operation'] < 25) {
            $diagnosis[] = "Operasional belum efisien dan sulit diskalakan.";
        }

        if ($scores['finance'] < 25) {
            $diagnosis[] = "Keuangan bisnis tidak sehat. Cashflow dan margin perlu diperbaiki.";
        }

        if (empty($diagnosis)) {
            $diagnosis[] = "Struktur bisnis cukup sehat dan memiliki potensi scaling.";
        }

        return $diagnosis;
    }
}