<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'phone',
        'status'
    ];

    protected static function booting()
    {
        static::creating(function (Ad $ad) {
            $ad->slug = Str::slug($ad->title);
        });
    }
}
