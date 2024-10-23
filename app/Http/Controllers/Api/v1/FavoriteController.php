<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Fashion;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{


    function index()
    {
        $products = Product::query()
            ->select('products.*', DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                'product_styles.name as style_name','product_structures.name as structure_name',
                'product_seasons.name as season_name','catalog_categories.name as catalog_category_name','product_categories.name as product_category_name',)
            ->with('images', 'sizes')
            ->having('is_favorite', '=', 1)
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
            ->get();

        $fashions = Fashion::query()->select('fashions.*',
            DB::raw('(favorites.id IS NOT NULL) as is_favorite'), 'baskets.type as basket_type')
            ->with('products')
            ->withCount('products as count_products')
            ->leftJoin('baskets', 'baskets.fashion_id', '=', 'fashions.id')
            ->where('baskets.user_id', auth()->user()->id)
            ->where('baskets.type', 'fashion')
            ->leftJoin('favorites', function ($join) {
                $join->on('favorites.favorite_id', '=', 'fashions.id')
                    ->where('favorites.type', '=', 'fashion')
                    ->where('favorites.user_id', '=', auth()->user()->id);
            })->get();


        $products->transform(function ($item) {
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


        $data = [
            'products' => $products,
            'fashions' => $fashions
        ];
        return result($data, 200, 'Favorites list');

    }

    function favorite(Request $request)
    {
        if (auth()->user()) {
            if ($request->is_favorite == 1) {
                $is_exists = Favorite::query()
                    ->where([
                        'user_id' => auth()->id(),
                        'favorite_id' => $request->get('favorite_id'),
                        'type' => $request->get('type'),
                    ])
                    ->exists();
                if ($is_exists) {
                    return result(true, 200, 'Уже добавился');
                }
                Favorite::create([
                    'user_id' => auth()->id(),
                    'favorite_id' => $request->get('favorite_id'),
                    'type' => $request->get('type'),
                ]);
                return result(true, 200, 'Успешно добавился');
            } elseif ($request->is_favorite == 0) {
                Favorite::query()
                    ->where([
                        'user_id' => auth()->id(),
                        'favorite_id' => $request->get('favorite_id'),
                        'type' => $request->get('type'),
                    ])
                    ->delete();
                return result(true, 200, 'Успешно');
            }

        } else {
            return result(false, 401, 'Unauthorized');
        }


    }


        function order(Request $request)
        {
            Order::query()->create([
                'date' => $request->get('date'),
                'user_id' => auth()->user()->id,
                'time'=>$request->get('time'),
                'type'=>$request->get('type'),
                'selled_id'=>$request->get('selled_id'),
                'product_size'=>$request->get('product_size'),
            ]);

            return result(true,200,"Success");
        }

}
