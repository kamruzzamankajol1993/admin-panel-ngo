<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildNoteForFdThree extends Model
{
    use HasFactory;

    protected $table = "child_note_for_fd_threes";

    protected $fillable = [
        'parent_note_for_fd_three_id',
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

    public function parentNoteForFdThree()
    {
        return $this->belongsTo(ParentNoteForFdThree::class,'parent_note_for_fd_three_id');
    }
}
