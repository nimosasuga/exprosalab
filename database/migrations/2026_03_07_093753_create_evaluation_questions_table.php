<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluation_questions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('category_id')
                  ->constrained('evaluation_categories')
                  ->cascadeOnDelete();

            $table->text('question');

            $table->string('code');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluation_questions');
    }
};