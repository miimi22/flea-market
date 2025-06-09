<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'item_id',
        'trading_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
