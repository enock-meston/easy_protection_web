<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    //
    public function selectAllCategoryApi()
    {
        $categories = Category::all();

        if ($categories->isEmpty() || $categories == null || $categories == '' || !$categories) {
            return response()->json(['message' => 'No category found'], 404);
        }
        return response()->json(['category' => $categories]);
    }

}
