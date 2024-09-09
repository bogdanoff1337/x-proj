<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SteamItemPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'market_hash_name',
        'price',
    ];
}
