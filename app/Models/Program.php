<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name',
        'code',
        'faculty_id'
    ];

    public function faculty()
    {
        return $this->belongsTo(\App\Models\Faculty::class);
    }

    public function users()
    {
        return $this->hasMany(\App\User::class);
    }

    public function students()
    {
        $role = \App\Models\Role::where('name', 'estudiante')->first();
        return $role->users()->where('program_id', $this->id)->get();
    }

    public function studentsPaginate($total)
    {
        $role = \App\Models\Role::where('name', 'estudiante')->first();
        $role;
        return $role->users()->where('program_id', $this->id)->paginate($total);
    }

    public function teachers()
    {
        $role = \App\Models\Role::where('name', 'docente')->first();
        $role;
        return $role->users()->where('program_id', $this->id)->get();
    }

    public function teachersPaginate($total)
    {
        $role = \App\Models\Role::where('name', 'docente')->first();
        $role;
        return $role->users()->where('program_id', $this->id)->paginate($total);
    }
}
