<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'whatsapp_number',
        'password',
        'role',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Get the subscription associated with the user.
     */
    public function subscription()
    {
        return $this->hasOne(\App\Models\Subscription::class);
    }

    /**
     * Check if the user has an active (not expired) subscription.
     */
    public function hasActiveSubscription()
    {
        if (!$this->subscription) {
            return false;
        }

        return $this->subscription->expires_at > now();
    }

    // --- Helper Role Checks ---

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        // Jika $this->role adalah objek (relasi berhasil), cek properti name
        if (is_object($this->role)) {
            return $this->role->name === 'admin';
        }

        // Jika $this->role ternyata string (kolom database), cek langsung teksnya
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a premium member.
     */
    public function isPremium(): bool
    {
        if (is_object($this->role)) {
            return $this->role->name === 'premium';
        }

        return $this->role === 'premium';
    }

    /**
     * Check if the user is a free member.
     */
    public function isFree(): bool
    {
        if (is_object($this->role)) {
            return $this->role->name === 'free';
        }

        return $this->role === 'free';
    }
}
