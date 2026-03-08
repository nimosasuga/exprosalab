<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
        
            $table->id();
        
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
        
            $table->integer('market_score')->default(0);
            $table->integer('product_score')->default(0);
            $table->integer('marketing_score')->default(0);
            $table->integer('operation_score')->default(0);
            $table->integer('finance_score')->default(0);
        
            $table->integer('total_score')->default(0);
        
            $table->string('business_health')->nullable();
            // critical / weak / stable / strong
        
            $table->text('diagnosis')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
