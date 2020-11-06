<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name'
    ];

    public function faculty()
    {
        return $this->belongsTo(\App\Models\Faculty::class);
    }

    public function user()
    {
        return $this->hasMany(\App\User::class);
    }
}