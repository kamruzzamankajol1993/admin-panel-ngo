<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NothiFirstSenderList extends Model
{
    use HasFactory;
    protected $table = "nothi_first_sender_lists";
    protected $fillable = ['noteId','nothId','dakId','dakType','sender','receiver'];
}
