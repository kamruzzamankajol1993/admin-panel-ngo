<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NothiAttarct extends Model
{
    use HasFactory;
    protected $table = "nothi_attarcts";
    protected $fillable = ['organization_name','nothiId','noteId','adminId','nijOfficeId','otherOfficerName','otherOfficerAddress','otherOfficerDesignation','otherOfficerBranch','otherOfficerEmail','otherOfficerPhone','status'];
}
