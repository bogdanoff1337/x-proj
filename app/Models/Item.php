<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'user_id',
        'assetid',
        'classid',
        'instanceid',
        'market_hash_name',
        'name',
        'steam_price',
        'type',
        'icon_url',
        'float',
        'stickers',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
