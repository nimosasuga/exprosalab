<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationQuestionSeeder extends Seeder
{
    public function run(): void
    {

        $questions = [

        // MARKET
        ['category_id'=>1,'code'=>'market_1','question'=>'Apakah bisnis Anda memiliki target market yang jelas?'],
        ['category_id'=>1,'code'=>'market_2','question'=>'Apakah ada permintaan pasar yang stabil terhadap produk Anda?'],
        ['category_id'=>1,'code'=>'market_3','question'=>'Apakah pelanggan memahami manfaat produk Anda?'],
        ['category_id'=>1,'code'=>'market_4','question'=>'Apakah pasar Anda sedang berkembang?'],
        ['category_id'=>1,'code'=>'market_5','question'=>'Apakah Anda memahami masalah utama pelanggan?'],
        ['category_id'=>1,'code'=>'market_6','question'=>'Apakah ukuran pasar cukup besar untuk berkembang?'],
        ['category_id'=>1,'code'=>'market_7','question'=>'Apakah pelanggan aktif mencari solusi seperti produk Anda?'],
        ['category_id'=>1,'code'=>'market_8','question'=>'Apakah bisnis Anda memiliki positioning yang jelas di pasar?'],
        ['category_id'=>1,'code'=>'market_9','question'=>'Apakah kompetisi di pasar masih memungkinkan Anda berkembang?'],
        ['category_id'=>1,'code'=>'market_10','question'=>'Apakah bisnis Anda memiliki niche market yang spesifik?'],

        // PRODUCT
        ['category_id'=>2,'code'=>'product_1','question'=>'Apakah produk Anda menyelesaikan masalah nyata pelanggan?'],
        ['category_id'=>2,'code'=>'product_2','question'=>'Apakah kualitas produk konsisten?'],
        ['category_id'=>2,'code'=>'product_3','question'=>'Apakah pelanggan melakukan repeat order?'],
        ['category_id'=>2,'code'=>'product_4','question'=>'Apakah produk memiliki keunggulan dibanding kompetitor?'],
        ['category_id'=>2,'code'=>'product_5','question'=>'Apakah produk mudah dipahami oleh pelanggan?'],
        ['category_id'=>2,'code'=>'product_6','question'=>'Apakah pelanggan puas dengan produk Anda?'],
        ['category_id'=>2,'code'=>'product_7','question'=>'Apakah produk memiliki diferensiasi jelas?'],
        ['category_id'=>2,'code'=>'product_8','question'=>'Apakah produk dapat terus dikembangkan?'],
        ['category_id'=>2,'code'=>'product_9','question'=>'Apakah produk memiliki nilai unik di pasar?'],
        ['category_id'=>2,'code'=>'product_10','question'=>'Apakah produk memiliki standar kualitas yang jelas?'],

        // MARKETING
        ['category_id'=>3,'code'=>'marketing_1','question'=>'Apakah bisnis memiliki channel marketing utama?'],
        ['category_id'=>3,'code'=>'marketing_2','question'=>'Apakah bisnis memiliki sistem akuisisi pelanggan yang konsisten?'],
        ['category_id'=>3,'code'=>'marketing_3','question'=>'Apakah brand bisnis dikenal oleh target market?'],
        ['category_id'=>3,'code'=>'marketing_4','question'=>'Apakah bisnis memiliki strategi konten marketing?'],
        ['category_id'=>3,'code'=>'marketing_5','question'=>'Apakah bisnis memiliki funnel marketing yang jelas?'],
        ['category_id'=>3,'code'=>'marketing_6','question'=>'Apakah biaya akuisisi pelanggan masih sehat?'],
        ['category_id'=>3,'code'=>'marketing_7','question'=>'Apakah bisnis memiliki database pelanggan?'],
        ['category_id'=>3,'code'=>'marketing_8','question'=>'Apakah bisnis memanfaatkan digital marketing secara efektif?'],
        ['category_id'=>3,'code'=>'marketing_9','question'=>'Apakah bisnis memiliki sistem follow-up pelanggan?'],
        ['category_id'=>3,'code'=>'marketing_10','question'=>'Apakah strategi promosi menghasilkan konversi yang baik?'],

        // OPERATION
        ['category_id'=>4,'code'=>'operation_1','question'=>'Apakah proses operasional terdokumentasi dengan baik?'],
        ['category_id'=>4,'code'=>'operation_2','question'=>'Apakah bisnis dapat berjalan tanpa kehadiran owner setiap saat?'],
        ['category_id'=>4,'code'=>'operation_3','question'=>'Apakah tim memiliki pembagian tugas yang jelas?'],
        ['category_id'=>4,'code'=>'operation_4','question'=>'Apakah operasional bisnis efisien?'],
        ['category_id'=>4,'code'=>'operation_5','question'=>'Apakah ada sistem kontrol kualitas?'],
        ['category_id'=>4,'code'=>'operation_6','question'=>'Apakah bisnis memiliki SOP yang jelas?'],
        ['category_id'=>4,'code'=>'operation_7','question'=>'Apakah operasional dapat diskalakan?'],
        ['category_id'=>4,'code'=>'operation_8','question'=>'Apakah workflow kerja terstruktur?'],
        ['category_id'=>4,'code'=>'operation_9','question'=>'Apakah tim dapat bekerja secara mandiri?'],
        ['category_id'=>4,'code'=>'operation_10','question'=>'Apakah bisnis memiliki sistem monitoring kinerja?'],

        // FINANCE
        ['category_id'=>5,'code'=>'finance_1','question'=>'Apakah bisnis menghasilkan profit secara konsisten?'],
        ['category_id'=>5,'code'=>'finance_2','question'=>'Apakah cashflow bisnis stabil?'],
        ['category_id'=>5,'code'=>'finance_3','question'=>'Apakah bisnis memiliki laporan keuangan rutin?'],
        ['category_id'=>5,'code'=>'finance_4','question'=>'Apakah margin produk sehat?'],
        ['category_id'=>5,'code'=>'finance_5','question'=>'Apakah biaya operasional terkontrol?'],
        ['category_id'=>5,'code'=>'finance_6','question'=>'Apakah bisnis memiliki cadangan kas?'],
        ['category_id'=>5,'code'=>'finance_7','question'=>'Apakah harga produk memberikan keuntungan cukup?'],
        ['category_id'=>5,'code'=>'finance_8','question'=>'Apakah bisnis memiliki perencanaan keuangan?'],
        ['category_id'=>5,'code'=>'finance_9','question'=>'Apakah hutang bisnis terkendali?'],
        ['category_id'=>5,'code'=>'finance_10','question'=>'Apakah arus kas dapat diprediksi dengan baik?'],

        ];

        DB::table('evaluation_questions')->insert($questions);

    }
}