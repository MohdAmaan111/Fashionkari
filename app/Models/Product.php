<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'prod_name',
        'prod_slug',
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

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->prod_slug = Str::slug($product->prod_name . '-' . Str::random(4));
        });

        static::updating(function ($product) {
            if ($product->isDirty('prod_name')) {
                $product->prod_slug = Str::slug($product->prod_name . '-' . Str::random(4));
            }
        });
    }
}
