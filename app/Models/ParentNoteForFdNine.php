<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNoteForFdNine extends Model
{
    use HasFactory;
    protected $table = "parent_note_for_fd_nines";
    protected $fillable = [
        'fd_nine_doc_present_id',
        'serial_number',
        'subject',
        'name'
    ];

    public function childNoteForFdNines()
    {
        return $this->hasMany(ChildNoteForFdNine::class,'p_note_for_fd_nine_id');
    }
}
