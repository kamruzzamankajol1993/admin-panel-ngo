<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForwardingLetterOnulipi extends Model
{
    use HasFactory;

    protected $table = "forwarding_letter_onulipis";

    protected $fillable = ['forwarding_letter_id','onulipi_name'];

    public function forwardingLetter()
    {
        return $this->belongsTo(ForwardingLetter::class,'forwarding_letter_id');
    }
}
