<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Fashion;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{

    function index(Request $request)
    {

        $type = $request->input('type');
        if($type == 'fashion'){
            $data = Fashion::query()->select('fashions.*', DB::raw('(favorites.id IS NOT NULL) as is_favorite'),'baskets.type as basket_type')
                ->with('products')
                ->withCount('products as count_products')
                ->leftJoin('baskets','baskets.fashion_id','=','fashions.id')
                ->where('baskets.user_id',auth()->user()->id)
                ->where('baskets.type','fashion')
                ->leftJoin('favorites', function ($join) {
                    $join->on('favorites.favorite_id', '=', 'fashions.id')
                        ->where('favorites.type', '=', 'fashion')
                        ->where('favorites.user_id', '=', auth()->user()->id);
                })->get();


        }else{
            $data = Product::query()->select('products.*',  DB::raw('(favorites.id IS NOT NULL) as is_favorite'), 'baskets.type as basket_type','baskets.product_size')
                ->with('images','sizes')
                ->leftJoin('favorites', function ($join) {
                    $join->on('favorites.favorite_id', '=', 'products.id')
                        ->where('favorites.type', '=', 'product')
                        ->where('favorites.user_id', '=', auth()->user()->id);
                })
                ->leftJoin('baskets','baskets.product_id','=','products.id')
                ->where('baskets.type','product')
                ->where('baskets.user_id',auth()->user()->id)
                ->get();
        }




        return result($data,200,'Корзина');

    }
}
