<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function ratingsCount()
    {
        return $this->hasManyThrough(Rating::class, Book::class)->selectRaw('count(*) as ratings_count')->groupBy('author_id');
    }
}
