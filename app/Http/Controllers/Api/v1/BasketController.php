<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Fashion;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{

    function index(Request $request)
    {

        $type = $request->input('type');
        if($type == 'fashion'){

            $data = Fashion::query()
                ->select(
                    'fashions.*',
                    DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                    'baskets.type as basket_type',
                    'baskets.id as basket_id',
                    'shops.id as shop_id',
                    'shops.name as shop_name'
                )
                ->with('products.images', 'images')
                ->withCount('products as count_products')
                ->leftJoin('baskets', 'baskets.fashion_id', '=', 'fashions.id')
                ->leftJoin('shops', 'fashions.shop_id', '=', 'shops.id') // Assuming fashions table has shop_id
                ->leftJoin('favorites', function ($join) {
                    $join->on('favorites.favorite_id', '=', 'fashions.id')
                        ->where('favorites.type', '=', 'fashion')
                        ->where('favorites.user_id', '=', auth()->user()->id);
                })
                ->where('baskets.user_id', auth()->user()->id)
                ->where('baskets.type', 'fashion')
                ->get();

// Transform the data into shop-based grouping
            $groupedData = $data->groupBy('shop_id')->map(function ($items, $shopId) {
                $shop = $items->first(); // Get shop info from the first item
                return [
                    'shop'=>Shop::query()->where('id', $shopId)->first(),
                    'fashions' => $items->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->name,
                            'is_favorite' => $item->is_favorite,
                            'basket_type' => $item->basket_type,
                            'basket_id' => $item->basket_id,
                            'count_products' => $item->count_products,
                            'products' => $item->products,
                            'images' => $item->images,
                        ];
                    }),
                ];
            })->values();


        }

        else{


            $data = Product::query()
                ->select(
                    'products.*',
                    DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                    'baskets.type as basket_type',
                    'baskets.product_size',
                    'product_styles.name as style_name',
                    'product_structures.name as structure_name',
                    'product_seasons.name as season_name',
                    'catalog_categories.name as catalog_category_name',
                    'baskets.id as basket_id',
                    'shops.name as shop_name', // Assuming you have a shop name
                    'shops.id as shop_id' // Assuming you have a shop ID
                )
                ->with('images', 'sizes.productSizes','color','subcatalog')
                ->leftJoin('favorites', function ($join) {
                    $join->on('favorites.favorite_id', '=', 'products.id')
                        ->where('favorites.type', '=', 'product')
                        ->where('favorites.user_id', '=', auth()->user()->id);
                })
                ->leftJoin('baskets', 'baskets.product_id', '=', 'products.id')
                ->leftJoin('product_styles', 'products.style_id', '=', 'product_styles.id')
                ->leftJoin('product_structures', 'products.struture_id', '=', 'product_structures.id')
                ->leftJoin('product_seasons', 'products.season_id', '=', 'product_seasons.id')
                ->leftJoin('catalog_categories', 'products.catalog_category_id', '=', 'catalog_categories.id')
                ->leftJoin('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                ->leftJoin('shops', 'products.shop_id', '=', 'shops.id') // Join with shops table
                ->where('baskets.type', 'product')
                ->where('baskets.user_id', auth()->user()->id)
                ->get();

// Transform the data
            $groupedData = $data->transform(function ($item) {
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
            })->groupBy('shop_id') // Group by shop_id
            ->map(function ($products, $shopId) {
                $shopName = $products->first()->shop_name; // Assuming all products have the same shop_name
                return [
                    'shop'=> Shop::query()->where('id',$shopId)->first(),
                    'products' => $products->values(),
                ];
            })
                ->values();

        }




        return result($groupedData,200,'Корзина');

    }


    function delete(Request $request){
        $basketId = $request->input('basketId');
        Basket::query()->where('id',$basketId)->delete();
        return result(true,200,'Basket deleted successfully');
    }
}
