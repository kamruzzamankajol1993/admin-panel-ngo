<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNoteForDuplicateCertificate extends Model
{
    use HasFactory;

    protected $table = "parent_note_for_duplicate_certificates";
    protected $fillable = [
        'nothi_detail_id',
        'serial_number',
        'subject',
        'name'
    ];
}
