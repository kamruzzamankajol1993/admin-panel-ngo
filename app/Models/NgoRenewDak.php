<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgoRenewDak extends Model
{
    use HasFactory;

    protected $table = "ngo_renew_daks";

    protected $fillable = [

        'nothi_jat_id',
        'nothi_jat_status',
        'dak_detail_id',
        'attraction_attention',
        'informational_purposes',
        'copy_of_work',
        'sender_admin_id',
        'receiver_admin_id',
        'renew_status_id',
        'original_recipient',
        'status',
        'sent_status',
        'present_status',
        'amPmValue',
        'file_last_check_date',
        'check_status'

    ];
}
