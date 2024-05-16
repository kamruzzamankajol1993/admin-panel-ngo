<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNoteForFdThree extends Model
{
    use HasFactory;
    protected $table = "parent_note_for_fd_threes";
    protected $fillable = [
        'fd_three_doc_present_id',
        'serial_number',
        'subject',
        'name'
    ];


    public function childNoteForFdThrees()
    {
        return $this->hasMany(ChildNoteForFdThree::class,'parent_note_for_fd_three_id');
    }
}
