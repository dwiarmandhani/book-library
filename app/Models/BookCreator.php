<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCreator extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function books()
    {
        return $this->hasMany(Book::class, 'book_creator_id');
    }
    public static function getById($creatorId)
    {
        // Menggunakan metode find() untuk mengambil data berdasarkan ID
        return self::find($creatorId);
    }
}
