<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\AttributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::latest('id')->pluck('name');
        return $attributes;
    }

    public function attributeValues(Attribute $attribute)
    {
        $attributeValues = AttributeValue::whereAttributeId($attribute->id)->latest('id')->pluck('value');
        return $attributeValues;
    }
}
