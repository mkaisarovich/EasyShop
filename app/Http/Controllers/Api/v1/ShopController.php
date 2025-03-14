<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Mall;
use App\Models\Shop;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    function index(Request $request){

//dd(123);

        if(auth()->check()){
            $data = Shop::query()->with('owner');

            if($request->has('search')){
                $data->where('name', 'like', '%' . $request->search . '%');
            }
            if($request->has('city_id')){
                $data->where('city_id',$request->city_id);
            }
            if($request->mall_id != 0){
//            return 123;
                $data->where('mall_id',$request->mall_id);
            }
            if($request->mall_id == 0){
//            return 123;
                $data->where('mall_id',null);
            }

            $data = $data->get();
            $userId = auth()->user()->id;

// Loop through each shop and check subscription status
            foreach ($data as $shop) {
                $subscribe = Subscribe::query()
                    ->where('user_id', $userId)
                    ->where('shop_id', $shop->id)
                    ->exists();
                $shop->subscribe = $subscribe ? 1 : 0;
            }
        }else{
            $data = Shop::query()->with('owner');

            if($request->has('search')){
                $data->where('name', 'like', '%' . $request->search . '%');
            }
            if($request->has('city_id')){
                $data->where('city_id',$request->city_id);
            }
            if($request->mall_id != 0){
                $data->where('mall_id',$request->mall_id);
            }
            if($request->mall_id == 0){
                $data->where('mall_id',null);
            }

            $data = $data->get();
        }





//        return $data->get();


        return result($data,200,'Список магазинов');
    }

    function show(Shop $shop){
        $subscribe = Subscribe::query()->where('user_id',auth()->user()->id)->where('shop_id',$shop->id)->exists();
        $shop->subscribe = $subscribe ? 1 : 0;
//        $shop->save();


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

    function malls(Request $request){

        $data = Mall::query();
        if ($request->search) {
            $data->where('name', 'like', '%' . $request->search . '%');
        }
        if($request->city_id){
            $data->where('city_id',$request->city_id);
        }

        $data = $data->get();
        return result($data,200,'Malls');
    }



}
