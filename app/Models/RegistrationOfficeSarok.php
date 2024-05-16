<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationOfficeSarok extends Model
{
    use HasFactory;

    protected $table = "registration_office_saroks";
    protected $fillable = [
        'parent_note_regid',
        'office_subject',
        'office_sutro',
        'description',
        'extra_text',
        'sarok_number'
    ];


}
