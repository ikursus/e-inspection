<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachments';

    protected $fillable = [
        'inspection_id',
        'file'
    ];

    // Relation table attachment kepada table inspection
    public function inspection()
    {
        // return $this->belongsTo(Inspection::class);
        return $this->belongsTo(Inspection::class, 'inspection_id', 'id');
    }
}
