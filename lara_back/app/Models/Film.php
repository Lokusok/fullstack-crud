<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'films';

    protected $fillable = [
        'title',
        'description',
        'image_url'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
