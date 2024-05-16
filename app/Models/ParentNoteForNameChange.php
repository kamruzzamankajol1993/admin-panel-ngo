<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNoteForNameChange extends Model
{
    use HasFactory;
    protected $table = "parent_note_for_name_changes";
    protected $fillable = [
        'name_chane_doc_present_id',
        'serial_number',
        'subject',
        'name'
    ];


    public function childNoteForNameChanges()
    {
        return $this->hasMany(ChildNoteForNameChange::class,'parentnote_name_change_id');
    }
}
