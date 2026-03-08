<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EvaluationCategorySeeder extends Seeder
{
    public function run(): void
    {
        // Matikan pengecekan foreign key sementara
        Schema::disableForeignKeyConstraints();

        // Hapus data lama
        DB::table('evaluation_categories')->truncate();

        // Nyalakan kembali pengecekan foreign key
        Schema::enableForeignKeyConstraints();

        DB::table('evaluation_categories')->insert([
            [
                'name' => 'Market',
                'code' => 'market'
            ],
            [
                'name' => 'Visibility',
                'code' => 'visibility'
            ],
            [
                'name' => 'Conversion',
                'code' => 'conversion'
            ],
            [
                'name' => 'Monetization',
                'code' => 'monetization'
            ],
            [
                'name' => 'System',
                'code' => 'system'
            ]
        ]);
    }
}
