<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildNoteForFdSix extends Model
{
    use HasFactory;

    protected $table = "child_note_for_fd_sixes";

    protected $fillable = [
        'parent_note_for_fdsix_id',
        'serial_number',
        'description',
        'admin_id',
        'receiver_id',
        'sent_status',
        'sender_id',
        'view_status',
        'back_sign_status',
        'amPmValue',
        'amPmValueUpdate'
    ];

    public function parentNoteForFdsix()
    {
        return $this->belongsTo(ParentNoteForFdsix::class,'parent_note_for_fdsix_id');
    }
}
