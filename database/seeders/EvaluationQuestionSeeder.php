<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EvaluationQuestionSeeder extends Seeder
{
    public function run(): void
    {
        // Matikan pengecekan foreign key sementara
        Schema::disableForeignKeyConstraints();

        // Hapus data lama
        DB::table('evaluation_questions')->truncate();

        // Nyalakan kembali
        Schema::enableForeignKeyConstraints();

        $questions = [
            // 1. MARKET (Product-Market Fit & Validasi Pasar)
            ['category_id'=>1,'code'=>'market_1','question'=>'Apakah Anda memiliki profil Ideal Customer Profile (ICP) atau target pasar yang spesifik?'],
            ['category_id'=>1,'code'=>'market_2','question'=>'Apakah masalah yang diselesaikan produk Anda sangat mendesak bagi pelanggan?'],
            ['category_id'=>1,'code'=>'market_3','question'=>'Apakah Anda tahu persis siapa kompetitor utama dan bagaimana Anda berbeda dari mereka?'],
            ['category_id'=>1,'code'=>'market_4','question'=>'Apakah ukuran pasar Anda cukup besar untuk mendukung skala pertumbuhan bisnis?'],
            ['category_id'=>1,'code'=>'market_5','question'=>'Apakah prospek sudah menyadari bahwa mereka memiliki masalah yang Anda selesaikan?'],
            ['category_id'=>1,'code'=>'market_6','question'=>'Apakah Anda memiliki keunggulan kompetitif (Unique Selling Proposition) yang sulit ditiru?'],
            ['category_id'=>1,'code'=>'market_7','question'=>'Apakah tren pasar saat ini mendukung pertumbuhan produk atau layanan Anda?'],
            ['category_id'=>1,'code'=>'market_8','question'=>'Apakah Anda secara rutin mengumpulkan umpan balik (feedback) langsung dari pelanggan?'],
            ['category_id'=>1,'code'=>'market_9','question'=>'Apakah produk Anda sudah terbukti mencapai Product-Market Fit (dibutuhkan & dicari)?'],
            ['category_id'=>1,'code'=>'market_10','question'=>'Apakah pasar bersedia membayar dengan harga yang Anda tetapkan tanpa banyak penolakan?'],

            // 2. VISIBILITY (Awareness, Trafik & Branding)
            ['category_id'=>2,'code'=>'visibility_1','question'=>'Apakah target pasar Anda mudah menemukan bisnis Anda secara online (Search/Sosmed)?'],
            ['category_id'=>2,'code'=>'visibility_2','question'=>'Apakah Anda memiliki strategi konten pemasaran yang konsisten?'],
            ['category_id'=>2,'code'=>'visibility_3','question'=>'Apakah Anda menggunakan lebih dari satu saluran (channel) untuk mendatangkan traffic?'],
            ['category_id'=>2,'code'=>'visibility_4','question'=>'Apakah biaya untuk mendatangkan pengunjung (Cost Per Click/View) masih efisien?'],
            ['category_id'=>2,'code'=>'visibility_5','question'=>'Apakah brand Anda memiliki identitas visual dan pesan yang konsisten di semua platform?'],
            ['category_id'=>2,'code'=>'visibility_6','question'=>'Apakah Anda aktif membangun interaksi dengan audiens (tidak hanya berjualan keras)?'],
            ['category_id'=>2,'code'=>'visibility_7','question'=>'Apakah Anda melacak metrik jangkauan (reach) dan impresi secara rutin?'],
            ['category_id'=>2,'code'=>'visibility_8','question'=>'Apakah Anda bekerja sama dengan mitra, komunitas, atau KOL/influencer untuk eksposur?'],
            ['category_id'=>2,'code'=>'visibility_9','question'=>'Apakah Anda mengoptimalkan SEO lokal atau mesin pencari untuk bisnis Anda?'],
            ['category_id'=>2,'code'=>'visibility_10','question'=>'Apakah materi iklan dan promosi Anda selalu berhasil menarik perhatian (Hook yang kuat)?'],

            // 3. CONVERSION (Sales Funnel & Closing)
            ['category_id'=>3,'code'=>'conversion_1','question'=>'Apakah Anda memiliki proses penjualan (sales funnel) yang jelas dari prospek ke pembeli?'],
            ['category_id'=>3,'code'=>'conversion_2','question'=>'Apakah tingkat konversi (conversion rate) website atau tim sales Anda memuaskan?'],
            ['category_id'=>3,'code'=>'conversion_3','question'=>'Apakah tim sales memiliki naskah (script) penawaran atau SOP closing yang teruji?'],
            ['category_id'=>3,'code'=>'conversion_4','question'=>'Apakah Anda memiliki sistem tindak lanjut (follow-up) rutin untuk prospek yang belum membeli?'],
            ['category_id'=>3,'code'=>'conversion_5','question'=>'Apakah penawaran (offer) Anda dikemas sangat menarik sehingga sulit ditolak pelanggan?'],
            ['category_id'=>3,'code'=>'conversion_6','question'=>'Apakah pelanggan merasa mudah saat melakukan proses pembelian atau checkout?'],
            ['category_id'=>3,'code'=>'conversion_7','question'=>'Apakah Anda memiliki cara efektif untuk menangani keberatan (objections) pelanggan?'],
            ['category_id'=>3,'code'=>'conversion_8','question'=>'Apakah Anda menggunakan elemen "Social Proof" (testimoni/review) untuk meyakinkan pembeli?'],
            ['category_id'=>3,'code'=>'conversion_9','question'=>'Apakah ada sistem retargeting/iklan ulang untuk orang yang baru sekadar melihat produk?'],
            ['category_id'=>3,'code'=>'conversion_10','question'=>'Apakah Anda melacak secara detail penyebab utama mengapa calon pembeli gagal membeli?'],

            // 4. MONETIZATION (Profitabilitas, LTV & Retensi)
            ['category_id'=>4,'code'=>'monetization_1','question'=>'Apakah margin keuntungan dari produk/layanan Anda sehat dan menutupi semua biaya?'],
            ['category_id'=>4,'code'=>'monetization_2','question'=>'Apakah Anda memiliki strategi Upsell, Cross-sell, atau Downsell saat transaksi terjadi?'],
            ['category_id'=>4,'code'=>'monetization_3','question'=>'Apakah pelanggan yang sudah membeli kembali lagi untuk melakukan repeat order?'],
            ['category_id'=>4,'code'=>'monetization_4','question'=>'Apakah Nilai Seumur Hidup Pelanggan (CLTV) Anda jauh lebih besar dari Biaya Akuisisinya (CAC)?'],
            ['category_id'=>4,'code'=>'monetization_5','question'=>'Apakah strategi penetapan harga Anda mencerminkan nilai sebenarnya yang pelanggan dapatkan?'],
            ['category_id'=>4,'code'=>'monetization_6','question'=>'Apakah Anda memiliki potensi/sistem model pendapatan berulang (subscription/retainer)?'],
            ['category_id'=>4,'code'=>'monetization_7','question'=>'Apakah Anda memiliki program referal yang membuat pelanggan lama mendatangkan pelanggan baru?'],
            ['category_id'=>4,'code'=>'monetization_8','question'=>'Apakah Anda mengetahui dengan pasti produk mana yang memberikan persentase profit terbesar?'],
            ['category_id'=>4,'code'=>'monetization_9','question'=>'Apakah harga bisa Anda naikkan tanpa takut kehilangan mayoritas pelanggan Anda?'],
            ['category_id'=>4,'code'=>'monetization_10','question'=>'Apakah proses penagihan piutang dan pemasukan kas Anda berjalan lancar?'],

            // 5. SYSTEM (Operasional, Tim, & Skalabilitas)
            ['category_id'=>5,'code'=>'system_1','question'=>'Apakah setiap alur kerja bisnis memiliki Standar Operasional Prosedur (SOP) yang tertulis?'],
            ['category_id'=>5,'code'=>'system_2','question'=>'Apakah bisnis dapat beroperasi normal jika Anda (Owner) tidak hadir selama satu bulan penuh?'],
            ['category_id'=>5,'code'=>'system_3','question'=>'Apakah Anda menggunakan software/tools untuk mengotomatisasi tugas-tugas administratif rutin?'],
            ['category_id'=>5,'code'=>'system_4','question'=>'Apakah setiap anggota tim memiliki peran dan Key Performance Indicator (KPI) yang jelas?'],
            ['category_id'=>5,'code'=>'system_5','question'=>'Apakah proses rekrutmen, onboarding, dan pelatihan karyawan baru sudah tersistem dengan baik?'],
            ['category_id'=>5,'code'=>'system_6','question'=>'Apakah bisnis memiliki sistem pelaporan keuangan (laba-rugi/cashflow) yang akurat tiap bulan?'],
            ['category_id'=>5,'code'=>'system_7','question'=>'Apakah infrastruktur dan kapasitas produksi siap jika tiba-tiba permintaan naik 3x lipat?'],
            ['category_id'=>5,'code'=>'system_8','question'=>'Apakah terdapat sistem Quality Control untuk menjamin standar kualitas produk selalu sama?'],
            ['category_id'=>5,'code'=>'system_9','question'=>'Apakah koordinasi dan pelacakan tugas antar divisi berjalan transparan dan terpusat?'],
            ['category_id'=>5,'code'=>'system_10','question'=>'Apakah Anda memiliki dashboard metrik bisnis utama yang dipantau harian/mingguan?'],
        ];

        DB::table('evaluation_questions')->insert($questions);
    }
}
