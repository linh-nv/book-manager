<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_code',
        'name',
        'email',
        'password',
        'birthday',
        'address',
        'tel',
        'gender',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lendTickets() {
        return $this->hasMany(LendTicket::class);
    }

    public function roles() {
        return $this->belongsTo(Role::class);
    }

    /*
    *
    * User code fomat là: XXxxx 
        Trong đó: 
            + XX là mã role (admin: AD, manager: MN)
            + xxx là id của user 
    *
    */ 
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $latestId = static::max('id') ?? 0;
            $user->user_code = 'MN' . str_pad($latestId + 1, 3, '0', STR_PAD_LEFT);
        });
    }
}
