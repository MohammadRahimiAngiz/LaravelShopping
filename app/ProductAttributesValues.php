<?php


namespace App;


use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductAttributesValues extends Pivot
{
    public function value()
    {
        return $this->belongsTo(AttributeValue::class,'value_id','id');
}
}
