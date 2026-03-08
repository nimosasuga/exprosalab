<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationCategorySeeder extends Seeder
{
    public function run(): void
    {

        DB::table('evaluation_categories')->insert([

            [
                'name' => 'Market',
                'code' => 'market'
            ],

            [
                'name' => 'Product',
                'code' => 'product'
            ],

            [
                'name' => 'Marketing',
                'code' => 'marketing'
            ],

            [
                'name' => 'Operation',
                'code' => 'operation'
            ],

            [
                'name' => 'Finance',
                'code' => 'finance'
            ]

        ]);

    }
}