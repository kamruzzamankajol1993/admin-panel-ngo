<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewOfficeSarok extends Model
{
    use HasFactory;
    protected $table = "renew_office_saroks";
    protected $fillable = [
        'parent_note_for_renew_id ',
        'office_subject',
        'office_sutro',
        'description',
        'extra_text',
        'sarok_number'
    ];
}
