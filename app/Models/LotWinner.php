<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotWinner extends Model
{
    use HasFactory;

    protected $fillable = [
        'lot_id',
        'user_id',
        'price',
        'status',
        'date',
    ];
}
