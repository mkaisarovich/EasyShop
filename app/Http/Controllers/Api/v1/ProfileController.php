<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\FavoriteSize;
use App\Models\Privacy;
use App\Models\Shop;
use App\Models\Size;
use App\Models\Subscribe;
use App\Models\User;
use App\Services\ShopService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    function index(){
        $data = User::query()->find(auth()->user()->id);

        $array = [
            'user' => $data,
            'favorite_sizes' => FavoriteSize::query()->where('user_id',auth()->user()->id)->get(),
        ];
        return result($array,200,'Profile Details');
    }

    function subscriptions()
    {
        $data = Subscribe::query()->with('shop')->where('user_id',auth()->user()->id)->get();
        return result($data,200,'Subscriptions');

    }

    function about_us()
    {
        $data = AboutUs::query()->get();
        return result($data,200,'About Us');
    }

    function privacy(){
        $data = Privacy::query()->get();
        return result($data,200,'Privacy');
    }





    function indexAdmin(){
//        $shop = Shop::query()->where('user_id',auth()->user()->id)->get();
//        return 123;
//        return ShopService::shop();
        return result(ShopService::shop(),200,'Profile Details');
    }


    function editAdmin(Request $request)
    {
    Shop::query()->where('id',ShopService::shop()->id)->update([
        'whatsapp'=>$request->get('whatsapp'),
    ]);
        return result(ShopService::shop(),200,'Profile Details Changed');
    }

    function favoriteSize(Request $request){
        $sizes = $request->sizes;

        foreach ($sizes as $size){
            FavoriteSize::query()->updateOrInsert([
                'user_id'=>auth()->user()->id,
                'size_id'=>$size,
            ],[
                'type'=>Size::query()->select('type')->where('id',$size)->value('type')
            ]);
        }

        return result(true,200,'Favorite Size changed');



    }


}
