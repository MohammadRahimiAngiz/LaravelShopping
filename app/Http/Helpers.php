<?php

use Illuminate\Support\Facades\Route;

if(!function_exists('isActive')){
    function isActive($key, $className ='active'){
        return Route::currentRouteName() == $key ? $className : '';
    }
}
