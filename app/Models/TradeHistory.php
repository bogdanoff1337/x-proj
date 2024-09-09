<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bot_id',
        'item_id',
        'trade_id',
    ];
}
