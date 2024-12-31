<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Facades\Storage;

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

    // 画像URL取得用のアクセサ
    public function getImageUrlAttribute() {
        if ($this->image) {
            return Storage::url('public/images/' . $this->image);
        }
        return asset('img/no-image.png');
    }
}
