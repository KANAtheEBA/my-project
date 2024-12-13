<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'platform',
        'genre',
        'launch_date',
        'purchase_date',
        'developer',
        'publisher',
        'image',
        'user_id'
    ];
    
    public function genres() {
        return $this->hasMany(Genre::class, 'game_genres')->withTimeStamps();
    }
}
