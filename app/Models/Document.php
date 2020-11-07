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

    public function dtype()
    {
        return $this->belongsTo(\App\Models\Document_type::class, 'document_type_id');
    }
}
