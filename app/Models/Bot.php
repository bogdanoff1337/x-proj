<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;

    protected $fillable = [
        'steam_id',
        'name',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
