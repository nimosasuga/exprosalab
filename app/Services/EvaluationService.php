<?php

namespace App\Services;

class EvaluationService
{
    /**
     * Menghitung status kesehatan bisnis berdasarkan total skor.
     */
    public function determineHealthStatus(int $totalScore): string
    {
        if ($totalScore <= 80) return 'Critical';
        if ($totalScore <= 130) return 'Weak';
        if ($totalScore <= 180) return 'Stable';
        return 'Strong';
    }

    /**
     * Menghasilkan diagnosis sederhana berdasarkan skor kategori.
     */
    public function generateDiagnosis(array $categoryScores): array
    {
        $recommendations = [];

        if (($categoryScores['marketing'] ?? 0) < 25) {
            $recommendations[] = "Kelemahan utama pada akuisisi pelanggan. Bangun channel marketing yang konsisten.";
        }

        if (($categoryScores['finance'] ?? 0) < 25) {
            $recommendations[] = "Risiko finansial tinggi. Perbaiki cashflow dan perketat kontrol biaya.";
        }

        return $recommendations;
    }
}