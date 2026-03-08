<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
    $this->call([
        EvaluationCategorySeeder::class,
        EvaluationQuestionSeeder::class,
    ]);
    }
}