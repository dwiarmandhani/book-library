<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image', 'book_creator_id'];

    public function author()
    {
        return $this->belongsTo(BookCreator::class, 'book_creator_id');
    }
}
