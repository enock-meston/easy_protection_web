<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    // fillable
    protected $fillable = [
        'product_id',
        'image_path',
    ];

    // relationships
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
