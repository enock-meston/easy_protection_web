<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart_count' => collect($cart)->sum('quantity'),
        ]);
    }

    public function count()
    {
        $cart = session()->get('cart', []);
        return response()->json([
            'count' => collect($cart)->sum('quantity'),
        ]);
    }


    public function items()
    {
        $cart = session()->get('cart', []);

        return response()->json([
            'items' => array_values($cart), // Ensure array is indexed
        ]);
    }


    public function clear()
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }
}
