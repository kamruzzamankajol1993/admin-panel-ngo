<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NothiCopy extends Model
{
    use HasFactory;
    protected $table = "nothi_copies";
    protected $fillable = ['organization_name','nothiId','noteId','adminId','nijOfficeId','otherOfficerName','otherOfficerAddress','otherOfficerDesignation','otherOfficerBranch','otherOfficerEmail','otherOfficerPhone','status'];
}
