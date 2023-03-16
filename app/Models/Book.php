<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $hidden = ['id', 'created_at', 'updated_at'];
    protected $fillable = [
        'title',
        'author',
        'collection',
        'isbn',
        'genre_id',
        'pages',
        'status',
        'position',
        'content',
        'published_at'
    ];

    public function genre(){
        return $this->belongsTo(Genre::class);
    }
}
