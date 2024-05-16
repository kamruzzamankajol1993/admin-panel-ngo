<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationList extends Model
{
    use HasFactory;

    protected $table = "designation_lists";

    protected $fillable = ['branch_id','designation_name','designation_serial'];




}
