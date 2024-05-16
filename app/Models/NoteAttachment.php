<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteAttachment extends Model
{
    use HasFactory;
    protected $table = "note_attachments";
    protected $fillable = ['noteId','nothiId','dakId','dakType','child_id','title','link','admin_id'];
}
