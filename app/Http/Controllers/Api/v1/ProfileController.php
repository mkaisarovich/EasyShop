<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Privacy;
use App\Models\Shop;
use App\Models\Subscribe;
use App\Models\User;
use App\Services\ShopService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    function index(){
        $data = User::query()->find(auth()->user()->id);
        return result($data,200,'Profile Details');
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
}
