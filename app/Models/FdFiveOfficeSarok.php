<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FdFiveOfficeSarok extends Model
{
    use HasFactory;
    protected $table = "fd_five_office_saroks";

    protected $fillable = [
        'pnote_fd_five',
        'office_subject',
        'office_sutro',
        'description',
        'extra_text',
        'sarok_number'
    ];
}
