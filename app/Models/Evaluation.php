<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    // Tambahkan status, current_step, total_score, dan business_health
    protected $fillable = [
        'business_id',
        'business_health',
        'total_score',
        'status',
        'current_step'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
