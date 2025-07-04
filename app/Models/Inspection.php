<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    // Tetapkan data - data yang boleh disimpan
    protected $fillable = [
        'user_id',
        'tarikh',
        'masa',
        'tempat',
        'tempat_sub',
        'remarks',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relation table inspection kepada table attachments
    public function attachments()
    {
        // return $this->hasMany(Attachment::class);
        return $this->hasMany(Attachment::class, 'inspection_id', 'id');
    }
}
