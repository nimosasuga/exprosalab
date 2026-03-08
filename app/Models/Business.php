<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'user_id',
        'business_name',
        'industry',
        'stage',
        'monthly_revenue',
        'monthly_profit',
        'employee_count'
    ];

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
