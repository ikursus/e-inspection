<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    // Tetapkan maklumat table yang perlu dihubungi oleh Model Jabatan
    // Jika tidak, model akan automatik mencari table yang ejaannya plural kepada Jabatan
    protected $table = 'jabatan';

    // Tetapkan data - data yang boleh disimpan
    protected $fillable = [
        'name',
    ];
}
