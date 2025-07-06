<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    // fillable properties
    protected $fillable = [
        'name',
        'image',
        'description',
        'slug',
        'status', // Assuming you have a status field
    ];
}
