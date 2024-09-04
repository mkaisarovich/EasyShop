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
            ->select('products.*', DB::raw('(favorites.id IS NOT NULL) as is_favorite'))
            ->with('images', 'sizes')
            ->having('is_favorite', '=', 1)
            ->leftJoin('favorites', function ($join) {
                $join->on('favorites.favorite_id', '=', 'products.id')
                    ->where('favorites.type', '=', 'product')
                    ->where('favorites.user_id', '=', auth()->user()->id);
            })
            ->get();

        $fashions = Fashion::query()->select('fashions.*', DB::raw('(favorites.id IS NOT NULL) as is_favorite'), 'baskets.type as basket_type')
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
            ]);

            return result(true,200,"Success");
        }

}
