<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDesignationHistory extends Model
{
    use HasFactory;
    protected $table = "admin_designation_histories";

    protected $fillable = ['admin_id','designation_list_id','admin_job_start_date'];
}
