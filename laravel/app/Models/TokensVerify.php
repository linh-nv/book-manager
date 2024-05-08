<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokensVerify extends Model
{
    use HasFactory;

    protected $table = 'token_verify';
    
    protected $fillable = [
        'email',
        'token',
        'expires_at',
    ];

    public $timestamps = false;
}
