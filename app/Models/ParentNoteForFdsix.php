<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNoteForFdsix extends Model
{
    use HasFactory;
    protected $table = "parent_note_for_fdsixes";
    protected $fillable = [
        'fd_six_doc_present_id',
        'serial_number',
        'subject',
        'name'
    ];


    public function childNoteForFdSixs()
    {
        return $this->hasMany(ChildNoteForFdSix::class,'parent_note_for_fdsix_id');
    }
}
