<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNoteForFcTwo extends Model
{
    use HasFactory;
    protected $table = "parent_note_for_fc_twos";
    protected $fillable = [
        'fc_two_doc_present_id',
        'serial_number',
        'subject',
        'name'
    ];


    public function childNoteForFcTwos()
    {
        return $this->hasMany(ChildNoteForFcTwo::class,'parent_note_for_fc_two_id');
    }
}
