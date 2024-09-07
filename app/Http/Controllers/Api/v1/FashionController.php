<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Fashion;
use App\Models\FashionProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FashionController extends Controller
{

    function index(Request $request)
    {
        $shopId = $request->get('shop_id');
        $shop = Shop::query()->findOrFail($shopId);

        $fashions = Fashion::query()
            ->select('fashions.*', DB::raw('COALESCE(discount_price, price) as effective_price'), DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                'product_styles.name as style_name','product_seasons.name as season_name')
            ->with(['products' => function ($query) {
                $query->leftJoin('favorites as product_favorites', function ($join) {
                    $join->on('product_favorites.favorite_id', '=', 'products.id')
                        ->where('product_favorites.type', '=', 'product')
                        ->where('product_favorites.user_id', '=', auth()->user()->id);
                })
                    ->leftJoin('product_styles', 'products.style_id', '=', 'product_styles.id')
                    ->leftJoin('product_seasons', 'products.season_id', '=', 'product_seasons.id')
                    ->leftJoin('product_structures', 'products.struture_id', '=', 'product_structures.id')
                    ->select('products.*',DB::raw('(product_favorites.id IS NOT NULL) as product_favorite_id'),'product_styles.name as style_name',
                        'product_seasons.name as season_name','product_structures.name as structure_name');
            }])
            ->where('fashions.shop_id', $shop->id)
            ->withCount('products as count_products')
            ->leftJoin('favorites', function ($join) {
                $join->on('favorites.favorite_id', '=', 'fashions.id')
                    ->where('favorites.type', '=', 'fashion')
                    ->where('favorites.user_id', '=', auth()->user()->id);
            })
            ->leftJoin('product_styles','fashions.style_id','=','product_styles.id')
            ->leftJoin('product_seasons','fashions.season_id','=','product_seasons.id');


        $sort_price = $request->get('sort_price');
        $style_id = $request->get('style_id');
        $season_id = $request->get('season_id');

        $fashions->when($style_id, function ($query, $style_id) {
            return $query->where('style_id', $style_id);
        });
        $fashions->when($season_id, function ($query, $season_id) {
            return $query->where('season_id', $season_id);
        });
        $fashions->when($sort_price, function ($query, $sort_price) {
            return $query->orderBy('effective_price', $sort_price);
        });

            $fashions=$fashions->get();

        $fashions->transform(function ($item) {
            $item->style = [
                'id' => $item->style_id,
                'name' => $item->style_name,
            ];
            unset($item->style_id, $item->style_name);

            $item->season = [
                'id' => $item->season_id,
                'name' => $item->season_name,
            ];
            unset($item->season_id, $item->season_name);

            $item->products->transform(function ($product) {
                $product->style = [
                    'id' => $product->style_id,
                    'name' => $product->style_name,
                ];
                unset($product->style_id, $product->style_name);

                $product->season = [
                    'id' => $product->season_id,
                    'name' => $product->season_name,
                ];
                unset($product->season_id, $product->season_name);

                $product->structure = [
                    'id' => $product->struture_id,
                    'name' => $product->structure_name,
                ];
                unset($product->struture_id, $product->structure_name);

                return $product;
            });

            return $item;
        });

        return result($fashions,200,'Список образ и капсул');
    }


    function products(Request $request){
        $shopId = $request->get('shop_id');
        $shop = Shop::query()->findOrFail($shopId);
//        $type = $request->get('type');
        $categoryId = $request->get('category_id');


        $data = Product::query()
            ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'))
            ->with('images','sizes')
            ->leftJoin('favorites', function ($join) {
                $join->on('favorites.favorite_id', '=', 'products.id')
                    ->where('favorites.type', '=', 'product')
                    ->where('favorites.user_id', '=', auth()->user()->id);
            })
            ->where(['products.shop_id'=>$shop->id,'products.product_category_id'=>$categoryId])->get();

        return result($data,200,'Product list');
    }

    function product_category()
    {
        $data = ProductCategory::query()->get();
        return result($data,200,'Category list');
    }

    function create(Request $request){
        $shopId = $request->get('shop_id');
        $shop = Shop::query()->findOrFail($shopId);
        if($request->fashion_type){


            $fashionArray = [
                'name'=>'Образ номер ' . random_int(0, 999),
                'user_id'=>auth()->user()->id,
                'season_id'=>$request->get('season_id'),
                'style_id'=>$request->get('style_id'),
                'price'=>$request->get('price'),
                'discount_price'=>$request->get('discount_price'),
                'shop_id'=>$shop->id
            ];

            $fashion = Fashion::query()->create($fashionArray);

            if($request->products_id){
                foreach ($request->products_id as $product_id){
                    FashionProduct::query()->create([
                        'fashion_id'=>$fashion->id,
                        'product_id'=>$product_id
                    ]);
                }
            }

            Basket::query()->create([
                'type'=>'fashion',
                'fashion_id'=>$fashion->id,
                'user_id'=>auth()->user()->id,
                'shop_id'=>$shop->id
            ]);

            $data = Fashion::query()
                ->select('fashions.*')
                ->with('products')
                ->where('fashions.id', $fashion->id)
                ->withCount('products as count_products')->get();

            return result($data,200,'Успешно создался образ и добавился в корзину');
        }else{
            Basket::query()->create([
                'type'=>'fashion',
                'fashion_id'=>$request->fashion_id,
                'user_id'=>auth()->user()->id,
                'shop_id'=>$shop->id
            ]);
            $data = Fashion::query()
                ->select('fashions.*')
                ->with('products')
                ->where('fashions.id', $request->fashion_id)
                ->withCount('products as count_products')->get();
            return result($data,200,'Успешно добавился в корзину');
        }


    }


}
