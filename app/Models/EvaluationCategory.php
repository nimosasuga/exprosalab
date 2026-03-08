<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationCategory extends Model
{

    protected $fillable = [
        'name',
        'code'
    ];

    public function questions()
    {
        return $this->hasMany(EvaluationQuestion::class,'category_id');
    }

}
