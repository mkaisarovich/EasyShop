<?php

namespace App\Services;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Query\JoinClause;
use App\Models\Shop;

class ShopService
{



    public static string $type;
//    public static int $shop_id;

    public static function shop()
    {
        $user_id = auth()->user()->id;
           return Shop::query()->where('user_id', $user_id)->first();


//        return self::$shop_id;
    }







}
