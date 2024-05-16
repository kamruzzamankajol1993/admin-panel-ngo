<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildNoteForRenew extends Model
{
    use HasFactory;

    protected $table = "child_note_for_renews";

    protected $fillable = [
        'parent_note_for_renew_id',
        'serial_number',
        'description',
        'admin_id',
        'receiver_id',
        'sender_id',
        'sent_status',
        'sender_id',
        'view_status',
        'back_sign_status',
        'amPmValue',
        'amPmValueUpdate'
    ];


    public function parentNoteForRenew()
    {
        return $this->belongsTo(ParentNoteForRenew::class,'parent_note_for_renew_id');
    }
}
