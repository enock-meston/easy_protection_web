<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlutterPayment extends Model
{
    //
    protected $fillable = [
        'tx_ref',
        'email',
        'name',
        'phone',
        'amount',
        'currency',
        'quantity',
        'status',
        'payment_status',
    ];

}
