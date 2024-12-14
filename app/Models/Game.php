<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'platform',
        'launch_date',
        'purchase_date',
        'developer',
        'publisher',
        'image',
        'user_id'
    ];
    
    public function genres() {
        return $this->belongsToMany(Genre::class, 'game_genres', 'game_id', 'genre_id');
    }
}
