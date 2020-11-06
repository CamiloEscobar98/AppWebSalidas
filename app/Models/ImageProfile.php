<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageProfile extends Model
{
    protected $fillable = [
        'image',
        'url'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
