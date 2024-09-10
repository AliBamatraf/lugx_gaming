<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'game_id',
        'quantity',
        'total_price',
    ];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function Game()
    {
        return $this->belongsTo(Game::class);
    }
}
