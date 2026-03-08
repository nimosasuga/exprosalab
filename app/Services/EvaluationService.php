<?php

namespace App\Services;

class EvaluationService
{
    /**
     * Menghitung status kesehatan bisnis berdasarkan total skor.
     * Skor Maksimal = 250 (50 pertanyaan x 5)
     */
    public function determineHealthStatus(int $totalScore): string
    {
        if ($totalScore <= 100) return 'Kritis (Critical)';
        if ($totalScore <= 150) return 'Rentan (Weak)';
        if ($totalScore <= 200) return 'Stabil (Stable)';
        return 'Kuat (Strong)';
    }

    /**
     * Menghasilkan diagnosis dan rekomendasi berdasarkan skor tiap kategori.
     * Skor maksimal per kategori = 50. Batas aman (threshold) = 35.
     */
    public function generateDiagnosis(array $scores): array
    {
        $diagnosis = [];

        if (($scores['market'] ?? 0) < 35) {
            $diagnosis[] = "Market: Validasi pasar masih lemah. Anda berisiko membuat produk yang tidak dibutuhkan atau menyasar audiens yang salah.";
        }

        if (($scores['visibility'] ?? 0) < 35) {
            $diagnosis[] = "Visibility: Jangkauan brand rendah. Target pasar kesulitan menemukan bisnis atau penawaran Anda.";
        }

        if (($scores['conversion'] ?? 0) < 35) {
            $diagnosis[] = "Conversion: Banyak prospek yang bocor. Perbaiki penawaran, funnel penjualan, dan cara tim menangani penolakan.";
        }

        if (($scores['monetization'] ?? 0) < 35) {
            $diagnosis[] = "Monetization: Profitabilitas belum maksimal. Evaluasi kembali margin keuntungan, nilai umur pelanggan (LTV), dan strategi pricing.";
        }

        if (($scores['system'] ?? 0) < 35) {
            $diagnosis[] = "System: Operasional masih terlalu bergantung pada Anda (Owner). Bisnis sulit di-scale up tanpa SOP dan pendelegasian yang baik.";
        }

        if (empty($diagnosis)) {
            $diagnosis[] = "Selamat! Kelima pilar bisnis Anda berkinerja sangat baik dan pondasi sudah siap untuk di-scale up secara masif.";
        }

        return $diagnosis;
    }
}
