<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // fillable
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'unit',
        'thumbnail',
        'status',
        'category_id'
    ];
    // relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
