<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

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
