<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobHistory extends Model
{
    use HasFactory;

    protected $table = "job_histories";

    protected $fillable = ['designation_list_id','admin_id','start_date','end_date'];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }
}
