<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildNoteForFdSeven extends Model
{
    use HasFactory;

    protected $table = "child_note_for_fd_sevens";


    protected $fillable = [
        'parent_note_for_fd_seven_id',
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

    public function parentNoteForFdSeven()
    {
        return $this->belongsTo(ParentNoteForFdSeven::class,'parent_note_for_fd_seven_id');
    }
}
