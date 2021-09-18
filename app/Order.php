<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status', 'price', 'tracking_serial'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

//    public function getPriceAttribute($value)
//    {
//        return $value.' $';
//    }
}
