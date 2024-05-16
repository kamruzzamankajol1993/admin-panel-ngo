<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fd9ForwardingLetterEdit extends Model
{
    use HasFactory;

    protected $table = "fd9_forwarding_letter_edits";

    protected $fillable = ['forwarding_letter_id','pdf_part_one','pdf_part_two'];

    public function forwardingLetter()
    {
        return $this->belongsTo(ForwardingLetter::class,'forwarding_letter_id');
    }
}
