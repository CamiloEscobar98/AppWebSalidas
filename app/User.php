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
        'birthday',
        'document_id',
        'image_id',
        'program_id',
    ];

    public function fullname()
    {
        return $this->name . ' ' . $this->lastname;
    }

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

    public function hasRoleSession($role)
    {
        $aux = $this->roles()->where('name', $role)->first();
        if ($aux) {
            if ($aux->name == session('role')) {
                return true;
            }
        }
        return false;
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }

    public function hasAnyRoleSession($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRoleSession($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRoleSession($roles)) {
                return true;
            }
        }
        return false;
    }
}
