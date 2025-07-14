<?php

namespace App\Http\Controllers;

use App\Models\FlutterPayment;
use Illuminate\Http\Request;

class MyOrdersController extends Controller
{
    // select all orders from flutter_payments table by email
    public function index(Request $request){
        $orders = FlutterPayment::where('email', $request->email)->get();
        return view('my-orders', compact('orders'));
    }
}
