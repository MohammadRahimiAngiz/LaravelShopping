<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $fillable = ['image', 'alt','product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
