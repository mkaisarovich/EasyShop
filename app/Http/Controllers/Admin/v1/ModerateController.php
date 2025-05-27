<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class ModerateController extends Controller
{
    function index(){

        $data = User::query()
            ->select('users.*','shops.moderate','shops.id as shop_id')
            ->leftJoin('shops', 'shops.user_id', '=', 'users.id')
            ->where('users.role','partner')
//            ->where('shops.moderate',1)
            ->get();
//        return $data;
        return view('admin.pages.super_admin.moderate.index', compact('data'));
    }

    function status(Shop $shop,Request $request){
//        return $shop;
        $shop->moderate=1;
        $shop->save();
        return back()->withSuccess('Успех');
    }

}
