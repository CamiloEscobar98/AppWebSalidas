<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'lastname',
        'code',
        'password',
        'emailu',
        'email',
        'address',
        'phone',
        'birthday'
    ];

    protected $hidden = [
        'password'
    ];

    public function document()
    {
        return $this->belongsTo(\App\Models\Document::class);
    }

    public function image()
    {
        return $this->belongsTo(\App\Models\ImageProfile::class);
    }

    public function program()
    {
        return $this->belongsTo(\App\Models\Program::class);
    }

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'role_users');
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
