<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'slug', 
        'status', 
        'author_id', 
        'category_id', 
        'child_category_id',
        'regular_price', 
        'sale_price', 
        'publisher_id', 
        'publication_date', 
        'language',
        'pages', 
        'description', 
        'image_url',
    ];
}
