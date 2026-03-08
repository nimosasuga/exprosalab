<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'started_at',
        'expires_at',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}