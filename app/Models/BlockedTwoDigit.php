<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlockedTwoDigit extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'note'];

    public static function normalizeNumber(string $value): string
    {
        $d = preg_replace('/\D/', '', $value);

        return str_pad(substr($d, 0, 2), 2, '0', STR_PAD_LEFT);
    }

    public static function isBlocked(string $value): bool
    {
        $n = self::normalizeNumber($value);

        return self::where('number', $n)->exists();
    }
}
