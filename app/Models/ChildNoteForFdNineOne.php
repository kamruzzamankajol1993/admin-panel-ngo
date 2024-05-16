<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildNoteForFdNineOne extends Model
{
    use HasFactory;

    protected $table = "child_note_for_fd_nine_ones";


    protected $fillable = [
        'p_note_for_fd_nine_one_id',
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

    public function parentNoteForFdNineOne()
    {
        return $this->belongsTo(ParentNoteForFdNineOne::class,'p_note_for_fd_nine_one_id');
    }
}
