<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleActivity extends Model
{
    protected $guard = ['id'];

    public function participations()
    {
        return $this->hasMany(\App\Models\Participations::class);
    }
}
