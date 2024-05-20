<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

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
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
    
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

    public function role() {
        return $this->belongsTo(Role::class);
    }

    /*
    *
    * Format user code: XXxxx 
            + XX: role code (admin: AD, manager: MN)
            + xxx: user id
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
