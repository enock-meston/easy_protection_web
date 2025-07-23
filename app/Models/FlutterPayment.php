<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Mail\PaymentReceivedMail;
use Illuminate\Support\Facades\Mail;

class FlutterPayment extends Model
{
    //
    protected $fillable = [
        'tx_ref',
        'email',
        'name',
        'phone',
        'product_name',
        'amount',
        'currency',
        'quantity',
        'status',
        'payment_status',
    ];


    protected static function booted()
    {
        static::created(function ($payment) {
            // Send email here
            Mail::to('ndagijimanaenock11@gmail.com')->send(new PaymentReceivedMail($payment));
        });
    }
}
