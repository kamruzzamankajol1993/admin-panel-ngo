<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildNoteForFcTwo extends Model
{
    use HasFactory;

    protected $table = "child_note_for_fc_twos";


    protected $fillable = [
        'parent_note_for_fc_two_id',
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

    public function parentNoteForFcTwo()
    {
        return $this->belongsTo(ParentNoteForFcTwo::class,'parent_note_for_fc_two_id');
    }
}
