<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Fashion;
use App\Models\FashionProduct;
use App\Models\FavoriteSize;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FashionController extends Controller
{

    function index(Request $request)
    {

        if(auth()->check()){
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
                            'product_seasons.name as season_name','product_structures.name as structure_name')
                    ->with('images')
                    ;
                }])
                ->with('images')
                ->where('fashions.shop_id', $shop->id)
                ->where('fashions.is_active', 1)
                ->where('fashions.is_basket', 1)
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
        }else{
            $shopId = $request->get('shop_id');
            $shop = Shop::query()->findOrFail($shopId);

            $fashions = Fashion::query()
                ->select('fashions.*', DB::raw('COALESCE(discount_price, price) as effective_price'),
                    'product_styles.name as style_name','product_seasons.name as season_name')
                ->with(['products' => function ($query) {
                    $query
                        ->leftJoin('product_styles', 'products.style_id', '=', 'product_styles.id')
                        ->leftJoin('product_seasons', 'products.season_id', '=', 'product_seasons.id')
                        ->leftJoin('product_structures', 'products.struture_id', '=', 'product_structures.id')
                        ->select('products.*','product_styles.name as style_name',
                            'product_seasons.name as season_name','product_structures.name as structure_name')
                        ->with('images');
                }])
                ->with('images')
                ->where('fashions.shop_id', $shop->id)
                ->where('fashions.is_active', 1)
                ->where('fashions.is_basket', 1)
                ->withCount('products as count_products')
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
        }



        return result($fashions,200,'Список образ и капсул');
    }


    function products(Request $request){
        $shopId = $request->get('shop_id');
        $shop = Shop::query()->findOrFail($shopId);
//        $type = $request->get('type');
        $categoryId = $request->get('category_id');


//        $data = Product::query()
//            ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'))
//            ->with('images','sizes')
//            ->leftJoin('favorites', function ($join) {
//                $join->on('favorites.favorite_id', '=', 'products.id')
//                    ->where('favorites.type', '=', 'product')
//                    ->where('favorites.user_id', '=', auth()->user()->id);
//            })
//            ->where(['products.shop_id'=>$shop->id,'products.product_category_id'=>$categoryId])
//            ->get();
//
//        return result($data,200,'Product list');



        $shopId = $request->shop_id;
        $sort_price = $request->sort_price;
        $existsFavoriteSize = FavoriteSize::query()->where('user_id',auth()->user()->id)->exists();
        $seasonId = $request->season_id;
        $styleId = $request->style_id;
        $priceFrom = $request->price_from;
        $priceTo = $request->price_to;
        $discount = $request->discount;

        if($request->sizes){

                $data = Product::query()
                    ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                        'product_styles.name as style_name','product_structures.name as structure_name',
                        'product_seasons.name as season_name','catalog_categories.name as catalog_category_name')
                    ->with('images','sizes.productSizes')
                    ->where('products.shop_id',$shopId)
//                    ->where('products.catalog_category_id',$catalog)
                    ->where('products.product_category_id',$categoryId)
//                  ->where('products.count','>',0)
                    ->leftJoin('favorites', function ($join) {
                        $join->on('favorites.favorite_id', '=', 'products.id')
                            ->where('favorites.type', '=', 'product')
                            ->where('favorites.user_id', '=', auth()->user()->id);
                    })
                    ->leftJoin('product_styles','products.style_id','=','product_styles.id')
                    ->leftJoin('product_structures','products.struture_id','=','product_structures.id')
                    ->leftJoin('product_seasons','products.season_id','=','product_seasons.id')
                    ->leftJoin('catalog_categories','products.catalog_category_id','=','catalog_categories.id')
                    ->leftJoin('product_categories','products.product_category_id','=','product_categories.id')
                ;
                if($discount){
                    $data->whereNotNull('products.discount_price');
                }


        }
        else{
            if($existsFavoriteSize){

                $sizes = FavoriteSize::query()
                    ->where('user_id',auth()->user()->id)
                    ->pluck('id')
                    ->toArray();

                    $data = Product::query()
                        ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                            'product_styles.name as style_name','product_structures.name as structure_name',
                            'product_seasons.name as season_name','catalog_categories.name as catalog_category_name')
                        ->with('images','sizes.productSizes')
                        ->where('products.shop_id',$shopId)
                        ->where('products.product_category_id',$categoryId)
//                      ->where('products.count','>',0)
                        ->leftJoin('favorites', function ($join) {
                            $join->on('favorites.favorite_id', '=', 'products.id')
                                ->where('favorites.type', '=', 'product')
                                ->where('favorites.user_id', '=', auth()->user()->id);
                        })
                        ->whereIn('product_sizes.id',$sizes)
                        ->leftJoin('product_sizes','product_sizes.product_id','=','products.id')
                        ->leftJoin('product_styles','products.style_id','=','product_styles.id')
                        ->leftJoin('product_structures','products.struture_id','=','product_structures.id')
                        ->leftJoin('product_seasons','products.season_id','=','product_seasons.id')
                        ->leftJoin('catalog_categories','products.catalog_category_id','=','catalog_categories.id')
                        ->leftJoin('product_categories','products.product_category_id','=','product_categories.id')
                    ;
                    if($discount){
                        $data->whereNotNull('products.discount_price');
                    }


            }
            else{
                    $data = Product::query()
                        ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                            'product_styles.name as style_name','product_structures.name as structure_name',
                            'product_seasons.name as season_name','catalog_categories.name as catalog_category_name')
                        ->with('images','sizes.productSizes')
                        ->where('products.shop_id',$shopId)
//                      ->where('products.count','>',0)
                        ->where('products.product_category_id',$categoryId)
                        ->leftJoin('favorites', function ($join) {
                            $join->on('favorites.favorite_id', '=', 'products.id')
                                ->where('favorites.type', '=', 'product')
                                ->where('favorites.user_id', '=', auth()->user()->id);
                        })
                        ->leftJoin('product_styles','products.style_id','=','product_styles.id')
                        ->leftJoin('product_structures','products.struture_id','=','product_structures.id')
                        ->leftJoin('product_seasons','products.season_id','=','product_seasons.id')
                        ->leftJoin('catalog_categories','products.catalog_category_id','=','catalog_categories.id')
                        ->leftJoin('product_categories','products.product_category_id','=','product_categories.id')
                    ;
                    if($discount){
                        $data->whereNotNull('products.discount_price');
                    }


            }
        }









        if($sort_price){
            $data->orderBy('products.price',$sort_price);
        }
        if($styleId){
            $data->where('products.style_id',$styleId);
        }
        if($seasonId){
            $data->where('products.season_id',$seasonId);
        }
        if($priceFrom and $priceTo){
            $data->whereBetween('products.price',[$priceFrom,$priceTo]);
        }



        $data = $data->get();

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
        if($request->fashion_type == 'true'){


            $fashionArray = [
                'name'=>'Образ номер ' . random_int(0, 999),
                'user_id'=>auth()->user()->id,
                'season_id'=>$request->get('season_id'),
                'style_id'=>$request->get('style_id'),
                'price'=>$request->get('price'),
                'discount_price'=>$request->get('discount_price'),
                'shop_id'=>$shop->id,
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
                ->with('products','images')
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



    function createFashion(Request $request){
        $basketIds = $request->basket_id;

        if($basketIds){
            foreach ($basketIds as $basketId){
                $fashionId = Basket::query()->select('fashion_id')->where('id',$basketId)->value('fashion_id');
                $fashion = Fashion::query()->findOrFail($fashionId);
                $fashion->is_active = 1;
                $fashion->is_basket = 1;
                $fashion->save();

                Basket::query()->where('id',$basketId)->delete();
            }


            return result(true,200,'Created order fashion');
        }


    }


    function generate(Request $request){
        $data = [];

        $types = ['hat','t_shirt','hoody','trousers','bag','shoes','accessory'];

        foreach ($types as $type){
            $random = Product::query()->
                with('sizes.productSizes')->where([
                'type'=> $type,
                'shop_id'=>$request->get('shop_id'),
                ])
                ->leftJoin('product_sizes','product_sizes.product_id','=','products.id');
            if($request->season_id){
                $random->where('season_id',$request->get('season_id'));
            }
            if($request->structure_id){
                $random->where('struture_id',$request->get('structure_id'));
            }
            if($request->style_id){
                $random->where('style_id',$request->get('style_id'));
            }
            if($request->discount == 1){
                $random->where('discount',1);
            }
            if($request->sizes){
                $random->whereIn('product_sizes.size_id',$request->get('sizes'));
            }
            if($request->price_from and $request->price_to){
                $random->whereBetween('price', [$request->price_from, $request->price_to]);
            }

                $random = $random->get();
            $randomValue = $random->isNotEmpty() ? $random->random() : null;
            $data[$type] = $randomValue;
        }

        return result($data);


    }


}
