<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Inner Join Ke Tabel Category
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    // Inner Join Ke Tabel User
    public function users()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
