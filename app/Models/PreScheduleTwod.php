<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreScheduleTwod extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_date',
        'open_time',
        'set',
        'value',
        'number',
        'status',
    ];

    protected $casts = [
        'schedule_date' => 'date',
    ];
}
