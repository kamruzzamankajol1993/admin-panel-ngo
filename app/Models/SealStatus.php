<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SealStatus extends Model
{
    use HasFactory;

    protected $table = "seal_statuses";
    protected $fillable = [

        'noteId',
        'nothiId',
        'childId',
        'receiver',
        'status',
        'seal_status',
        'e_name',
        'e_designation',
        'e_branch',
        'e_sign',
        'amPmValue',
        'amPmValueUpdate',
        'delete_status',

    ];
}
