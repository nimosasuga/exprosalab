<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('action_plans', function (Blueprint $table) {
            // Tambahkan kolom priority dengan default 'Strategic'
            $table->string('priority')->default('Strategic')->after('category');
        });
    }

    public function down()
    {
        Schema::table('action_plans', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
};
