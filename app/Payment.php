<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=['resNumber','status'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
