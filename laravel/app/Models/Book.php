<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug', 
        'quantity',
        'description',
        'front_image', 
        'thumbnail', 
        'rear_image', 
        'category_id', 
        'author_id',  
        'publisher_id', 
        'price',     
    ];
    
    protected $hidden = [
        'category_id',
        'author_id',
        'publisher_id',
    ];

    public function category() {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function author() {
        return $this->belongsTo(Author::class,'author_id','id');
    }
    public function publisher() {
        return $this->belongsTo(Publisher::class,'publisher_id','id');
    }
}
