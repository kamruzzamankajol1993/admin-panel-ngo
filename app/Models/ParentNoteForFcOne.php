<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNoteForFcOne extends Model
{
    use HasFactory;
    protected $table = "parent_note_for_fc_ones";
    protected $fillable = [
        'fc_one_doc_present_id',
        'serial_number',
        'subject',
        'name'
    ];

    public function childNoteForFcOnes()
    {
        return $this->hasMany(ChildNoteForFcOne::class,'parent_note_for_fc_one_id');
    }
}
