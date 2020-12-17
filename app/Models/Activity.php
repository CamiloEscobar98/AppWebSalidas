<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'place',
        'date',
        'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(\App\User::class, 'teacher_id');
    }

    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'participations');
    }

    public function requirements()
    {
        return $this->hasMany(\App\Models\Requirement::class);
    }
}
