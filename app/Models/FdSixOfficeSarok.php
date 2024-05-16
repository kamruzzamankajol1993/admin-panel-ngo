<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FdSixOfficeSarok extends Model
{
    use HasFactory;

    protected $table = "fd_six_office_saroks";

    protected $fillable = [
        'parent_note_for_fdsix_id',
        'office_subject',
        'office_sutro',
        'description',
        'extra_text',
        'sarok_number'
    ];
}
