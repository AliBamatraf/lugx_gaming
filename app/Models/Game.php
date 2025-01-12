<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_game');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'orders');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }
}
