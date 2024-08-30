<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{



    function index()
    {
        $data = Product::query()
            ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'))
            ->with('images','sizes')
            ->having('is_favorite', '=', 1)
            ->leftJoin('favorites', function ($join) {
                $join->on('favorites.favorite_id', '=', 'products.id')
                    ->where('favorites.type', '=', 'product')
                    ->where('favorites.user_id', '=', auth()->user()->id);
            })
            ->get();
        return result($data,200,'Favorites list');

    }

    function favorite(Request $request){
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
                    return result(true,200,'Уже добавился');
                }
                Favorite::create([
                    'user_id' =>  auth()->id(),
                    'favorite_id' => $request->get('favorite_id'),
                    'type' => $request->get('type'),
                ]);
                return result(true,200,'Успешно добавился');
            } elseif ($request->is_favorite == 0) {
                Favorite::query()
                    ->where([
                        'user_id' =>  auth()->id(),
                        'favorite_id' => $request->get('favorite_id'),
                        'type' => $request->get('type'),
                    ])
                    ->delete();
                return result(true,200,'Успешно');
            }

        } else {
            return result(false, 401, 'Unauthorized');
        }
    }




}
