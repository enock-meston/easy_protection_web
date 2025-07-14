<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class BuyController extends Controller
{
     public function index(Request $request)
    {

        // my info
        $myId = Auth::user()->id;
        $myName = Auth::user()->name;
        $myPhone = Auth::user()->phone;
        $myEmail= Auth::user()->email;

        // Direct buy logic
        if ($request->has('product_id')) {
            $product = Product::find($request->product_id);
            if ($product) {
                $quantity = (int) $request->input('quantity', 1);
                // dd($quantity);
                $cart = [[
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                ]];
                $total = $product->price * $quantity;
                return view('buy', compact('cart', 'total','myName','myPhone','myEmail','quantity'));
            }
        }

        // Fallback to session cart
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('buy', compact('cart', 'total','myName','myPhone','myEmail'));
    }
}
