<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssaignTask extends Model
{
    use HasFactory;

    protected $table = "assaign_tasks";
    protected $fillable = [
        'task_id',
        'admin_id',
        'status',
    ];
}
