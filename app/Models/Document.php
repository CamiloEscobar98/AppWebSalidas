<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'document'
    ];

    public function user()
    {
        return $this->hasOne(\App\User::class);
    }

    public function document_type()
    {
        return $this->belongsTo(\App\Models\Document_type::class);
    }
}
