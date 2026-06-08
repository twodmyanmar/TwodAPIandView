<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDays extends Model
{
    use HasFactory;

    protected $table = 'event_days';
    protected $fillable = ['title', 'event_date'];



    public static function isEventDays($date): bool
    {
        return self::whereDate('event_date', $date)->exists();
    }
}
