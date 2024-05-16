<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationStep extends Model
{
    use HasFactory;

    protected $table = "designation_steps";

    protected $fillable = ['designation_list_id','designation_step','designation_serial'];


}
