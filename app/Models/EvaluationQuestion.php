<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationQuestion extends Model
{
    // Sesuaikan fillable dengan nama kolom di file migration yang baru
    protected $fillable = [
        'category_id',
        'question',
        'code'
    ];

    /**
     * Relasi: Setiap pertanyaan dimiliki oleh satu kategori
     */
    public function category()
    {
        return $this->belongsTo(EvaluationCategory::class, 'category_id');
    }
}
