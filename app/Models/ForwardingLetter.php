<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForwardingLetter extends Model
{
    use HasFactory;

    protected $table = "forwarding_letters";

    protected $fillable = ['admin_id','apply_date','apply_month_name','apply_year_name','sarok_number'];

    public function onuLipiList()
    {
        return $this->hasMany(ForwardingLetterOnulipi::class,'forwarding_letter_id');
    }

    public function fd9ForwardingLetterEdit()
    {
        return $this->hasMany(Fd9ForwardingLetterEdit::class,'forwarding_letter_id');
    }
}
