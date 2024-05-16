<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNoteForFdNineOne extends Model
{
    use HasFactory;
    protected $table = "parent_note_for_fd_nine_ones";
    protected $fillable = [
        'fd_nine_one_doc_present_id',
        'serial_number',
        'subject',
        'name'
    ];


    public function childNoteForFdNineOnes()
    {
        return $this->hasMany(ChildNoteForFdNineOne::class,'p_note_for_fd_nine_one_id');
    }
}
