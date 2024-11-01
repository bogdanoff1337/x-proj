<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lots extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_price',
        'user_id',
        'status',
        'end_date',
    ];
}
