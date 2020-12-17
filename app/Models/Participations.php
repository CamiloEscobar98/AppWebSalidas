<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participations extends Model
{
    protected $guard = ['id'];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function activity()
    {
        return $this->belongsTo(\App\Models\Activity::class);
    }

    public function activityRole()
    {
     return $this->belongsTo(\App\Models\RoleActivity::class);
    }
}
