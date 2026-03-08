<?php

namespace App\Services;

use App\Models\EvaluationAnswer;

class WeaknessDetectionService
{
    public function detect($userId)
    {
        $answers = EvaluationAnswer::with('question')
            ->where('user_id', $userId)
            ->get();

        $categories = [
            'market' => [],
            'product' => [],
            'marketing' => [],
            'operation' => [],
            'finance' => []
        ];

        foreach ($answers as $answer) {
            $rawCategory = $answer->question->category;
            $category = explode('_', $rawCategory)[0];
            if (!isset($categories[$category])) {
                continue;
            }
            $categories[$category][] = $answer->score;
        }

        $scores = [];
        foreach ($categories as $cat => $values) {
            if(count($values) == 0){
                $scores[$cat] = 0;
            } else {
                $scores[$cat] = array_sum($values) / count($values);
            }
        }

        asort($scores);
        $weakestCategory = array_key_first($scores);

        return [
            'scores' => $scores,
            'weakest_category' => $weakestCategory
        ];
    }
    
    public function biggestProblem($weakestCategory)
    {
        $problems = [
            'market' => 'Market tidak tervalidasi dengan jelas sehingga bisnis berisiko menjual ke audience yang salah.',
            'product' => 'Produk tidak memiliki diferensiasi kuat sehingga sulit bersaing di pasar.',
            'marketing' => 'Sistem marketing tidak konsisten sehingga bisnis kesulitan menghasilkan demand.',
            'operation' => 'Operasional bisnis tidak sistematis sehingga sulit scale.',
            'finance' => 'Kontrol keuangan lemah sehingga profit sulit dipertahankan.'
        ];

        return $problems[$weakestCategory] ?? null;
    }
    
    public function recommendation($weakestCategory)
    {
        $recommendations = [
            'market' => 'Lakukan validasi ulang target market menggunakan problem interview dan market research.',
            'product' => 'Perkuat value proposition dan diferensiasi produk.',
            'marketing' => 'Bangun sistem marketing funnel yang konsisten.',
            'operation' => 'Buat SOP operasional untuk setiap proses bisnis.',
            'finance' => 'Bangun sistem pencatatan keuangan dan kontrol cashflow.'
        ];

        return $recommendations[$weakestCategory] ?? null;
    }
}