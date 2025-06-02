<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'prod_name',
        'cat_id',
        'mrp',
        'selling_price',
        'images',
        'stock',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
