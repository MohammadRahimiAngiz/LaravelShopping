<?php


namespace App\Services\Cart;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use Ramsey\Collection\Collection;

/**
 * Class Cart
 * @package App\Services\Cart
 * @method static bool has($id)
 * @method static Collection all()
 * @method static array get($id)
 * @method  static Cart put(array $value,Model $obj=null)
 * @method static Collection flush()
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'cart';
    }
}
