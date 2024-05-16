<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNoteForRenew extends Model
{
    use HasFactory;
    protected $table = "parent_note_for_renews";
    protected $fillable = [
        'renew_doc_present_id',
        'serial_number',
        'subject',
        'name'
    ];

    public function childNoteForRenews()
    {
        return $this->hasMany(ChildNoteForRenew::class,'parent_note_for_renew_id');
    }
}
