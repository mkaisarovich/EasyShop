<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\CatalogCategory;
use App\Models\GenderAction;
use App\Models\Shop;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    function index(Shop $shop){

//        return $shop->id;


        $data = [
            'Женщины'=>GenderAction::query()->where(['shop_id'=>$shop->id,'gender_id'=>1])->exists() ? [] : CatalogCategory::query()->where('gender_id',1)->where('shop_id',$shop->id)->get(),
            'Мужчины'=>GenderAction::query()->where(['shop_id'=>$shop->id,'gender_id'=>2])->exists() ? [] : CatalogCategory::query()->where('gender_id',2)->where('shop_id',$shop->id)->get(),
            'Дети'=>GenderAction::query()->where(['shop_id'=>$shop->id,'gender_id'=>3])->exists() ? [] : CatalogCategory::query()->where('gender_id',3)->where('shop_id',$shop->id)->get(),
        ];
        return result($data,200,'Catalog List');
    }

}
