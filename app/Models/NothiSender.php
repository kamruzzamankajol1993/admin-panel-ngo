<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NothiSender extends Model
{
    use HasFactory;
    protected $table = "nothi_senders";
    protected $fillable = ['nothiId','noteId','adminId','status'];
}
