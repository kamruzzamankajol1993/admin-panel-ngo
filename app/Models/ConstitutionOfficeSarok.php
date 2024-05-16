<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstitutionOfficeSarok extends Model
{
    use HasFactory;

    protected $table = "constitution_office_saroks";
    
    protected $fillable = [
        'pnote_conid',
        'office_subject',
        'office_sutro',
        'description',
        'extra_text',
        'sarok_number'
    ];
}
