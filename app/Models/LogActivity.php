<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $table = "log_activities";

    protected $fillable = [
        'subject', 'url', 'method', 'ip_or_mac', 'agent', 'admin_id','activity_time'
    ];
}
