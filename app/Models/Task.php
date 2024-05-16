<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = "tasks";
    protected $fillable = [
        'task_type',
        'task_name',
        'description',
        'start_date',
        'end_date',
        'end_date_formate',
        'status',
        'admin_id',
    ];
}
