<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuplicateCertificateOfficeSarok extends Model
{
    use HasFactory;

    protected $table = "duplicate_certificate_office_saroks";

    protected $fillable = [
        'pnote_dupid',
        'office_subject',
        'office_sutro',
        'description',
        'extra_text',
        'sarok_number'
    ];
}
