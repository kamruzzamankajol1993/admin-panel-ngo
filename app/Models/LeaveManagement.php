<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveManagement extends Model
{
    use HasFactory;

    protected $table = "leave_management";

    protected $fillable = ['to_admin','applicate_date','subject','body','status','created_by'];

}
