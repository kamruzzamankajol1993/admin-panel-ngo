<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNoteForRegistration extends Model
{
    use HasFactory;
    protected $table = "parent_note_for_registrations";
    protected $fillable = [
        'registration_doc_id',
        'serial_number',
        'subject',
        'name'
    ];


    public function childNoteForRegistrations()
    {
        return $this->hasMany(ChildNoteForRegistration::class,'parent_note_regid');
    }
}
