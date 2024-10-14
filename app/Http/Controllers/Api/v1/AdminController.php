<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Fashion;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Services\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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


    function deleteProduct(Request $request){
        $type = $request->type;
        $selledId = $request->selled_id;
        if($type == 'product'){
            Product::query()->where('id',$selledId)->delete();
        }else{
            Fashion::query()->where('id',$selledId)->delete();
        }

        return result(true,200,'success deleted');


    }


    function switchProduct(Request $request){

        $type = $request->type;
        $selledId = $request->selled_id;
        $status = $request->status;
        if($type == 'product'){
            Product::query()->where('id',$selledId)->update(['status'=>$status]);
        }else{
            Fashion::query()->where('id',$selledId)->update(['status'=>$status]);
        }

        return result(true,200,'success updated');

    }


    function createProduct(Request $request){
        $type = $request->type;

        if($type == 'product'){
            $dataArray = [
                'name'=>$request->name,
                'description'=>$request->description,
                'shop_id'=>ShopService::shop()->id,
                'style_id'=>$request->style_id,
                'struture_id'=>$request->structure_id,
                'season_id'=>$request->season_id,
                'discount'=>$request->discount,
                'catalog_category_id'=>$request->catalog_category_id,
                'product_category_id'=>$request->product_category_id,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
                'type'=>$request->product_type
            ];

            $product = Product::query()->create($dataArray);

            if($product and ($request->sizes or $request->images )){
                for ($i = 0;$i<sizeof($request->sizes);$i++){
                    ProductSize::query()->create([
                       'size_id'=>(int)$request->sizes[$i],
                        'product_id'=>$product->id
                    ]);
                }

                foreach($request->images as $image){
                    ProductImage::query()->create([
                        'product_id'=>$product->id,
                        'image'=>config('app.url') . '/storage/' . Storage::disk('public')->put("products/image", $image)
                    ]);
                }

            }

            return result($product,200,'success created');

        }else{
//            Fashion::query()->where('id',$selledId)->update(['status'=>$status]);
        }

    }


    function editProduct(Request $request){
        $type = $request->type;
        $selledId = $request->selled_id;

        if($type == 'product'){
            $dataArray = [
                'name'=>$request->name,
                'description'=>$request->description,
                'shop_id'=>ShopService::shop()->id,
                'style_id'=>$request->style_id,
                'struture_id'=>$request->structure_id,
                'season_id'=>$request->season_id,
                'discount'=>$request->discount,
                'catalog_category_id'=>$request->catalog_category_id,
                'product_category_id'=>$request->product_category_id,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
                'type'=>$request->product_type
            ];

            Product::query()->where('id',$selledId)->update($dataArray);


                if($request->sizes){
                    ProductSize::query()->where('product_id',$selledId)->delete();
                    foreach ($request->sizes as $size){
                        ProductSize::query()->create([
                            'size_id'=>$size,
                            'product_id'=>$selledId
                        ]);
                    }
                }

                if($request->images){
                    ProductImage::query()->where('product_id',$selledId)->delete();
                    foreach ($request->images as $image){
                        ProductImage::query()->create([
                            'product_id'=>$selledId,
                            'image'=>config('app.url') . '/storage/' . Storage::disk('public')->put("products/image", $image)
                        ]);
                    }
                }

        }else{

        }

    }

}
