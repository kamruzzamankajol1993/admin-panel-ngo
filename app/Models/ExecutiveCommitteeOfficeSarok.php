<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExecutiveCommitteeOfficeSarok extends Model
{
    use HasFactory;

    protected $table = "executive_committee_office_saroks";

    protected $fillable = [
        'pnote_exeid',
        'office_subject',
        'office_sutro',
        'description',
        'extra_text',
        'sarok_number'
    ];
}
