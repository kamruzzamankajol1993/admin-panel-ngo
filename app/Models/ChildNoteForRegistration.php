<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildNoteForRegistration extends Model
{
    use HasFactory;

    protected $table = "child_note_for_registrations";

    protected $fillable = [
        'parent_note_regid',
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


    public function parentNoteForRegistration()
    {
        return $this->belongsTo(ParentNoteForRegistration::class,'parent_note_regid');
    }
}
