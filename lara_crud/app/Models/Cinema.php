<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $table = 'cinemas';

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
