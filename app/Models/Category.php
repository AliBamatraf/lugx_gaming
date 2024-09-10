<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'image'
    ];
    public function game()
    {
        return $this->belongsToMany(Game::class,'category_game');
    }
}
