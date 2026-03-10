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

    public function detailedActionPlan($weakestCategory)
    {
        $plans = [
            'market' => [
                ['title' => 'Wawancara 5 Calon Pelanggan Ideal', 'desc' => 'Gali masalah terdalam mereka. Jangan berjualan, cukup dengarkan keluhan mereka terkait industri Anda.'],
                ['title' => 'Rancang Unique Selling Proposition (USP)', 'desc' => 'Tuliskan 1 kalimat penawaran jelas yang membuat produk Anda 10x lebih menarik dari kompetitor terdekat.'],
                ['title' => 'Tes Penawaran Skala Kecil', 'desc' => 'Luncurkan pre-order, tester, atau landing page sederhana sebelum memproduksi produk dalam skala besar.']
            ],
            'visibility' => [
                ['title' => 'Kuasai 1 Channel Utama', 'desc' => 'Berhenti mencoba hadir di semua tempat. Pilih 1 platform (misal: Instagram, TikTok, atau SEO) yang paling sering dipakai target pasar Anda.'],
                ['title' => 'Buat Konten Edukasi/Hook Kuat', 'desc' => 'Bagikan tips gratis atau cerita yang relevan dengan masalah target pasar untuk memancing perhatian (Awareness).'],
                ['title' => 'Gunakan Iklan Retargeting', 'desc' => 'Pasang pelacak (Pixel/Tag) dan iklankan ulang penawaran Anda secara spesifik ke orang yang pernah berinteraksi sebelumnya.']
            ],
            'conversion' => [
                ['title' => 'Perbaiki Copywriting Penawaran', 'desc' => 'Fokus pada "Manfaat" bukan "Fitur". Jelaskan transformasi apa yang akan dialami pelanggan setelah membeli.'],
                ['title' => 'Buat SOP Follow-up', 'desc' => 'Wajibkan tim sales untuk mem-follow up prospek yang belum membeli setidaknya 3-5 kali dengan sudut pandang yang berbeda.'],
                ['title' => 'Hilangkan Hambatan Pembelian', 'desc' => 'Sederhanakan proses checkout, berikan garansi pengembalian uang (Risk Reversal), atau sediakan opsi cicilan.']
            ],
            'monetization' => [
                ['title' => 'Evaluasi Ulang Margin & Pricing', 'desc' => 'Hitung ulang Harga Pokok Penjualan (HPP) Anda. Jangan ragu menaikkan harga jika nilai (value) yang Anda berikan memang tinggi.'],
                ['title' => 'Rancang Sistem Upsell', 'desc' => 'Tawarkan produk pelengkap (komplementer) tepat saat pelanggan sedang melakukan pembayaran/checkout.'],
                ['title' => 'Buat Program Retensi', 'desc' => 'Hubungi kembali pelanggan lama Anda. Berikan penawaran eksklusif agar mereka melakukan repeat order.']
            ],
            'system' => [
                ['title' => 'Dokumentasikan Tugas Berulang', 'desc' => 'Tulis Standar Operasional Prosedur (SOP) langkah demi langkah untuk tugas yang Anda lakukan lebih dari 3 kali.'],
                ['title' => 'Delegasikan Fungsi Non-Inti', 'desc' => 'Rekrut staf administrasi atau gunakan freelancer untuk membebaskan waktu Anda dari pekerjaan teknis level bawah.'],
                ['title' => 'Gunakan Tools Otomatisasi', 'desc' => 'Implementasikan software seperti CRM, Email Autoresponder, atau aplikasi pembukuan untuk meminimalisir kesalahan manusia.']
            ]
        ];

        return $plans[$weakestCategory] ?? [
            ['title' => 'Lakukan Evaluasi', 'desc' => 'Silakan selesaikan evaluasi bisnis Anda terlebih dahulu.']
        ];
    }
}
