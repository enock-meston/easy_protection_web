<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyController extends Controller
{
     public function index()
    {

        // my info
        $myId = Auth::user()->id;
        $myName = Auth::user()->name;
        $myPhone = Auth::user()->phone;
        $myEmail= Auth::user()->email;

        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('buy', compact('cart', 'total','myName','myPhone','myEmail'));
    }
}
