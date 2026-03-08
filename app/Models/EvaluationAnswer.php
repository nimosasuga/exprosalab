<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationAnswer extends Model
{
    protected $fillable = [
        'evaluation_id',
        'question_id',
        'user_id', // Tambahkan ini agar tidak diblokir
        'score'
    ];

    public function question()
    {
        return $this->belongsTo(EvaluationQuestion::class, 'question_id');
    }
}
