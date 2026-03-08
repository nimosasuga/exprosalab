<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'business_id',
        'market_score',
        'product_score',
        'marketing_score',
        'operation_score',
        'finance_score',
        'total_score',
        'business_health',
        'diagnosis'
    ];
    
    public function answers()
    {
    return $this->hasMany(EvaluationAnswer::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}