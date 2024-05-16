<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildNoteForNameChange extends Model
{
    use HasFactory;

    protected $table = "child_note_for_name_changes";

    protected $fillable = [
        'parentnote_name_change_id',
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

    public function parentNoteForNameChange()
    {
        return $this->belongsTo(ParentNoteForNameChange::class,'parentnote_name_change_id');
    }
}
