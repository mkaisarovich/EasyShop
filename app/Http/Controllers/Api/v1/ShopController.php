<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    function index(Request $request){
        $data = Shop::query();

        if($request->has('search')){
            $data->where('name', 'like', '%' . $request->search . '%');
        }
        if($request->has('city_id')){
            $data->where('city_id',$request->city_id);
        }

        $data = $data->get();
        return result($data,200,'Список магазинов');
    }

    function show(Shop $shop){
        $subscribe = Subscribe::query()->where('user_id',auth()->user()->id)->where('shop_id',$shop->id)->exists();
        $shop->subscribe = $subscribe ? true : false;


        $categories = Category::all();
        $data = [
            'shop' => $shop,
            'categories'=>$categories
        ];
        return result($data,200,'Страница магазина');

    }

    function subscribe(Request $request,Shop $shop){
        $isSubscribe = $request->is_subscribe;
        if($isSubscribe == 1){
            Subscribe::query()->create([
                'user_id'=>auth()->user()->id,
                'shop_id'=>$shop->id
            ]);
        }else{
            Subscribe::query()->where([
                'user_id'=>auth()->user()->id,
                'shop_id'=>$shop->id
            ])->delete();
        }

        return result(true,200,'Success');

    }



}
