<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    //select all product and return json
    public function selectLimitProductApi()
    {
        $products = Product::orderBy('created_at', 'desc')->limit(4)->get();
        return response()->json(['product' => $products]);
    }

    public function selectAllProductApi()
    {
        $products = Product::all();
        return response()->json(['product' => $products]);
    }

    public function selectProductByIdApi($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'No product found'], 404);
        }
        return response()->json(['product' => $product]);

    }

    public function selectProductByCategoryApi($category)
    {
        $products = Product::where('category_id', $category)->get();

        if ($products->isEmpty() || $products == null || $products == '' || !$products) {
            return response()->json(['message' => 'No product found'], 404);
        }
        return response()->json(['product' => $products]);
    }

}
