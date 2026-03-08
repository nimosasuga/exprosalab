<?php

namespace App\Services;

use App\Models\EvaluationAnswer;
use App\Models\Evaluation;
use App\Models\Business;

class WeaknessDetectionService
{
    public function detect($userId)
    {
        // Cari bisnis milik user
        $business = Business::where('user_id', $userId)->first();
        if (!$business) {
            return ['scores' => [], 'weakest_category' => null, 'total_score' => 0, 'health_status' => 'Unknown'];
        }

        // Ambil evaluasi terakhir yang sudah selesai (completed)
        $latestEvaluation = Evaluation::where('business_id', $business->id)
            ->where('status', 'completed')
            ->latest()
            ->first();

        if (!$latestEvaluation) {
            return ['scores' => [], 'weakest_category' => null, 'total_score' => 0, 'health_status' => 'Unknown'];
        }

        // Ambil jawaban dari evaluasi tersebut
        $answers = EvaluationAnswer::with('question.category')
            ->where('evaluation_id', $latestEvaluation->id)
            ->get();

        $scores = [
            'market' => 0,
            'visibility' => 0,
            'conversion' => 0,
            'monetization' => 0,
            'system' => 0
        ];

        // Hitung skor
        foreach ($answers as $answer) {
            if ($answer->question && $answer->question->category) {
                $catCode = $answer->question->category->code;
                if (isset($scores[$catCode])) {
                    $scores[$catCode] += $answer->score;
                }
            }
        }

        // Cari kategori terlemah
        $weakestCategory = null;
        $lowestScore = 999;
        foreach ($scores as $cat => $score) {
            if ($score < $lowestScore) {
                $lowestScore = $score;
                $weakestCategory = $cat;
            }
        }

        return [
            'scores' => $scores,
            'weakest_category' => $weakestCategory,
            'total_score' => $latestEvaluation->total_score,
            'health_status' => $latestEvaluation->business_health
        ];
    }

    public function biggestProblem($weakestCategory)
    {
        $problems = [
            'market' => 'Produk berisiko tidak memiliki product-market fit yang kuat.',
            'visibility' => 'Brand kurang dikenal. Calon pelanggan kesulitan menemukan bisnis Anda.',
            'conversion' => 'Traffic gagal diubah menjadi pembeli. Ada kebocoran di sales funnel.',
            'monetization' => 'Margin tipis dan LTV rendah. Profitabilitas bisnis tidak maksimal.',
            'system' => 'Operasional berantakan dan terlalu bergantung pada Anda (Owner).'
        ];

        return $problems[$weakestCategory] ?? 'Belum ada data evaluasi.';
    }

    public function recommendation($weakestCategory)
    {
        $recommendations = [
            'market' => 'Validasi ulang Target Pasar dan pastikan solusi Anda menyelesaikan masalah mendesak.',
            'visibility' => 'Perbanyak channel akuisisi traffic (Ads, SEO, Sosmed) dan perbaiki positioning.',
            'conversion' => 'Perbaiki naskah penawaran (copywriting) dan optimalkan proses follow-up tim sales.',
            'monetization' => 'Evaluasi ulang pricing, buat sistem upsell/cross-sell, dan fokus pada retensi pelanggan.',
            'system' => 'Buat SOP tertulis, delegasikan tugas, dan gunakan tools otomatisasi.'
        ];

        return $recommendations[$weakestCategory] ?? 'Silakan lakukan evaluasi terlebih dahulu.';
    }
}
