<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'slug', 
        'description'
    ];
    
    public function books()
    {
        return $this->hasMany(Book::class)->orderBy('id','DESC');
    }

    protected static function boot()
    {
        parent::boot();
    
        static::deleting(function (Category $category) {
            $category->books()->delete();
        });
    }
}
