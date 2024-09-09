<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'status',
        'to_user_id',
        'lot_id',
    ];
}
