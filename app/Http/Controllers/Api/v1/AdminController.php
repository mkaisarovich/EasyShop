<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Fashion;
use App\Models\Product;
use App\Services\ShopService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function indexProducts(Request $request){
        $products = Product::query()->with('images','sizes')
            ->where(['shop_id'=>ShopService::shop()->id,'status'=>$request->status])->get();
        $fashions = Fashion::query()  ->with('products')
            ->withCount('products as count_products')->where(['shop_id'=>ShopService::shop()->id])->get();

        $data = [
            'products' => $products,
            'fashions' => $fashions,
        ];

        return result($data,200,'Products List');
    }
}
