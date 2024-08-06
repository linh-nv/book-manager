<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preview extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'cover_image_url',
        'preview_content',
    ];
}
