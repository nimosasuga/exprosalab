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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        
            $table->string('business_name');
            $table->string('industry')->nullable();
            $table->string('stage')->nullable(); 
            // idea / early / growth / scale
        
            $table->decimal('monthly_revenue', 15, 2)->nullable();
            $table->decimal('monthly_profit', 15, 2)->nullable();
        
            $table->integer('employee_count')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
