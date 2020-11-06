<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'name'
    ];

    public function programs()
    {
        return $this->hasMany(\App\Models\Program::class);
    }
}
