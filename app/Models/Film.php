<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'films';

    protected $fillable = [
        'slug',
        'name',
        'genre',
        'photo',
        'rating',
        'country',
        'description',
        'release_date',
        'ticket_price',
    ];
}
