<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviewComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'preview_id',
        'content',
        'rating',
    ];
}
