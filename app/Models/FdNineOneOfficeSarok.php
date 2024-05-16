<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FdNineOneOfficeSarok extends Model
{
    use HasFactory;

    protected $table = "fd_nine_one_office_saroks";

    protected $fillable = [
        'p_note_for_fd_nine_one_id',
        'office_subject',
        'office_sutro',
        'description',
        'extra_text',
        'sarok_number'
    ];
}
