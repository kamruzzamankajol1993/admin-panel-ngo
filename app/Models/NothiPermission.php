<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NothiPermission extends Model
{
    use HasFactory;
    protected $table = "nothi_permissions";
    protected $fillable = ['nothId','branchId','adminId'];
}
