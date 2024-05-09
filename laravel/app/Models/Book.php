<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    public function categories() {
        return $this->belongsTo(Category::class);
    }
    public function author() {
        return $this->belongsTo(Author::class);
    }
    public function publisher() {
        return $this->belongsTo(Publisher::class);
    }
}
