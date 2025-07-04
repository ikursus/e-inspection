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
}
