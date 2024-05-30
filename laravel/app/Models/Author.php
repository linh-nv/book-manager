<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'name',
        'description'
    ];

    public function books()
    {
        
        return $this->hasMany(Book::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Author $author) {
            $author->books()->delete();
        });
    }
}
