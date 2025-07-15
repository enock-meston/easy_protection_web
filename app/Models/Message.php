<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //fillable
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'subject', 'message'];
}
