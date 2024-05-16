<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DakDetail extends Model
{
    use HasFactory;

    protected $table = "dak_details";

    protected $fillable = [

        'comment',
        'main_file',
        'access_id',
        'sender_id',
        'decision_list',
        'decision_list_detail',
        'priority_list',
        'secret_list',
        'status'

    ];

}
