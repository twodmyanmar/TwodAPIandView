<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FourResults extends Model
{
    use HasFactory;

    protected $fillable = [
        'set',
        'value',
        'number',
        'status',
        'recorded_at',
        'open_time',
    ];

    protected $dates = ['recorded_at'];
}
