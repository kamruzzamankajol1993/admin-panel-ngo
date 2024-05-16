<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentNotForExecutiveCommittee extends Model
{
    use HasFactory;

    protected $table = "parent_not_for_executive_committees";
    protected $fillable = [
        'nothi_detail_id',
        'serial_number',
        'subject',
        'name'
    ];
}
