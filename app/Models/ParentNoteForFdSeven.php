<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNoteForFdSeven extends Model
{
    use HasFactory;
    protected $table = "parent_note_for_fd_sevens";
    protected $fillable = [
        'fd_seven_doc_present_id',
        'serial_number',
        'subject',
        'name'
    ];

    public function childNoteForFdSevens()
    {
        return $this->hasMany(ChildNoteForFdSeven::class,'parent_note_for_fd_seven_id');
    }
}
