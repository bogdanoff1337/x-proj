<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'bot_id',
        'item_id',
    ];
}
