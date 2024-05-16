<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecruityCheck extends Model
{
    use HasFactory;
    protected $table = "secruity_checks";
    protected $fillable = ['n_visa_id','request_id','tracking_no','statusName','statusId'];
}
