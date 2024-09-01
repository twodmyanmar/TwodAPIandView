<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDays extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'event_date'];



    public static function isEventDays($date)
    {
        return self::where('title', 'event_date', $date)->exists();
    }
}
