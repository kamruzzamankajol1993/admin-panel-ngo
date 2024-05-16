<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemInformation extends Model
{
    use HasFactory;
    protected $table = "system_information";
    protected $fillable = [
        'system_admin_url','system_name','system_phone', 'system_email', 'system_address','system_url','system_logo','system_icon'
    ];
}
