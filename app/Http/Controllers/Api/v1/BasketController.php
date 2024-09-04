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
            $data = Product::query()->select('products.*',  DB::raw('(favorites.id IS NOT NULL) as is_favorite'), 'baskets.type as basket_type','baskets.product_size',
                'product_styles.name as style_name','product_structures.name as structure_name',
                'product_seasons.name as season_name','catalog_categories.name as catalog_category_name')
                ->with('images','sizes')
                ->leftJoin('favorites', function ($join) {
                    $join->on('favorites.favorite_id', '=', 'products.id')
                        ->where('favorites.type', '=', 'product')
                        ->where('favorites.user_id', '=', auth()->user()->id);
                })
                ->leftJoin('baskets','baskets.product_id','=','products.id')
                ->leftJoin('product_styles','products.style_id','=','product_styles.id')
                ->leftJoin('product_structures','products.struture_id','=','product_structures.id')
                ->leftJoin('product_seasons','products.season_id','=','product_seasons.id')
                ->leftJoin('catalog_categories','products.catalog_category_id','=','catalog_categories.id')
                ->leftJoin('product_categories','products.product_category_id','=','product_categories.id')
                ->where('baskets.type','product')
                ->where('baskets.user_id',auth()->user()->id)
                ->get();

            $data->transform(function ($item) {
                $item->style = [
                    'id' => $item->style_id,
                    'name' => $item->style_name,
                ];
                unset($item->style_id, $item->style_name);

                $item->structure = [
                    'id' => $item->struture_id,
                    'name' => $item->structure_name,
                ];
                unset($item->struture_id, $item->structure_name);

                $item->season = [
                    'id' => $item->season_id,
                    'name' => $item->season_name,
                ];
                unset($item->season_id, $item->season_name);

                $item->catalog_category = [
                    'id' => $item->catalog_category_id,
                    'name' => $item->catalog_category_name,
                ];
                unset($item->catalog_category_id, $item->catalog_category_name);

                $item->product_category = [
                    'id' => $item->product_category_id,
                    'name' => $item->product_category_name,
                ];
                unset($item->product_category_id, $item->product_category_name);

                return $item;
            });
        }




        return result($data,200,'Корзина');

    }
}
