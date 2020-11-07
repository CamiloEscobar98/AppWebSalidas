<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }
}
