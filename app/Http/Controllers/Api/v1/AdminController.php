<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Fashion;
use App\Models\FashionImage;
use App\Models\FashionProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Services\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    function indexProducts(Request $request){
        $products = Product::query()->with('images','sizes','season','structure','style','catalog_category','product_category')
            ->where(['shop_id'=>ShopService::shop()->id,'status'=>$request->status])->get();
        $fashions = Fashion::query()->with('products','images','products.season','products.structure','products.style','products.catalog_category','products.product_category')
            ->where(['status'=>$request->status])
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
                'color_id'=>$request->color_id,
                'struture_id'=>$request->structure_id,
                'season_id'=>$request->season_id,
                'discount'=>$request->discount,
                'catalog_category_id'=>$request->catalog_category_id,
                'product_category_id'=>$request->product_category_id,
                'price'=>$request->price,
                'discount_price'=>$request->discount != null? (int)$request->price - (((int)$request->price * (int)$request->discount) / 100 ) : null,
                'type'=>$request->product_type,
                'subcatalog_id'=>$request->subcatalog_id,
                'articul'=>$request->articul
//                'count'=>10
            ];

            $product = Product::query()->create($dataArray);

            if($product){
                if($request->sizes){
                    for ($i = 0;$i<sizeof($request->sizes);$i++){
                        ProductSize::query()->create([
                            'size_id'=>(int)$request->sizes[$i],
                            'product_id'=>$product->id,
                            'count'=>$request->count[$i]
                        ]);
                    }
                }

                if($request->images){
                    foreach($request->images as $image){
                        ProductImage::query()->create([
                            'product_id'=>$product->id,
                            'image'=>config('app.url') . '/storage/' . Storage::disk('public')->put("products/image", $image)
                        ]);
                    }
                }

            }

            return result($product,200,'success created');

        }
        else{
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
                'type'=>$request->product_type,
                'subcatalog_id'=>$request->subcatalog_id,
                'articul'=>$request->articul
//                'count'=>10
            ];

            Product::query()->where('id',$selledId)->update($dataArray);


                if($request->sizes){
                    ProductSize::query()->where('product_id',$selledId)->delete();
                    $i = 0;
                    foreach ($request->sizes as $size){
                        ProductSize::query()->create([
                            'size_id'=>$size,
                            'product_id'=>$selledId,
                            'count'=>$request->count[$i]
                        ]);
                        $i++;
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


    function indexOrders(Request $request)
    {
        $status = $request->status;
           $type = $request->type;
        if($type == 'product'){
            switch ($status) {
                case 'wait':
                    $data = Order::query()
                    ->with('product.images','product.season',
                        'product.style','product.structure','product.catalog_category','product.product_category')
                        ->where('type','product')
                        ->where('status_id', 1)
                        ->where('shop_id', ShopService::shop()->id)
                        ->get();

                    break;
                case 'accept':
                    $data = Order::query()
                        ->with('product.images','product.season',
                            'product.style','product.structure','product.catalog_category','product.product_category')
                        ->where('type','product')
                        ->where('status_id', 2)
                        ->where('shop_id', ShopService::shop()->id)
                        ->get();
                    break;
                case 'ready':
                    $data = Order::query()
                        ->with('product.images','product.season',
                            'product.style','product.structure','product.catalog_category','product.product_category')
                        ->where('type','product')
                        ->where('status_id', 3)
                        ->where('shop_id', ShopService::shop()->id)
                        ->get();
                    break;
                default;
            }
        }else{
            switch ($status) {
                case 'wait':
                    $data = Order::query()
                        ->with('fashion.products.images','fashion.products.season','fashion.products.style',
                            'fashion.products.structure','fashion.products.catalog_category',
                            'fashion.products.product_category')
                        ->where('type','fashion')
                        ->where('status_id', 1)
                        ->where('shop_id', ShopService::shop()->id)
                        ->get();
                    break;
                case 'accept':
                    $data = Order::query()
                        ->with('fashion.products.images','fashion.products.season','fashion.products.style',
                            'fashion.products.structure','fashion.products.catalog_category',
                            'fashion.products.product_category')
                        ->where('type','fashion')
                        ->where('status_id', 2)
                        ->where('shop_id', ShopService::shop()->id)
                        ->get();
                    break;
                case 'ready':
                    $data = Order::query()
                        ->with('fashion.products.images','fashion.products.season','fashion.products.style',
                            'fashion.products.structure','fashion.products.catalog_category',
                            'fashion.products.product_category')
                        ->where('type','fashion')
                        ->where('status_id', 3)
                        ->where('shop_id', ShopService::shop()->id)
                        ->get();
                    break;
                default;
            }
        }

        return result($data,200,'Orders List');

    }


    function changeStatus(Order $order,Request $request){
        switch ($request->status){
            case 'completed':
                $order->status_id = 4;
                break;
                case 'accept':
                    $order->status_id = 2;
                    break;
                    case 'ready':
                        $order->status_id = 3;
                        break;
                        default;
        }

        $order->save();
        return result(true,200,'Order Status Changed');
    }

    function createFashion(Request $request){

        $dataArray = [
            'name'=>$request->name,
//            'image'=>config('app.url') . '/storage/' . Storage::disk('public')->put("fashions/main_image", $request->main_image),
            'shop_id'=>ShopService::shop()->id,
            'style_id'=>$request->style_id,
            'season_id'=>$request->season_id,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'discount_price'=>$request->discount != null? (int)$request->price - (((int)$request->price * (int)$request->discount) / 100 ) : null,
            'user_id'=>auth()->id(),
            'is_active'=>1,
        ];

        $fashion = Fashion::query()->create($dataArray);

        if($fashion){
            if($request->images){
                $images = $request->images;
                    foreach ($images as $image){
                      FashionImage::query()->create([
                          'fashion_id'=>$fashion->id,
                          'image'=>config('app.url') . '/storage/' . Storage::disk('public')->put("fashions/images", $image)
                      ]);
                    }
            }

            if($request->products){
                foreach($request->products as $product){
                    FashionProduct::query()->create([
                       'fashion_id'=>$fashion->id,
                       'product_id'=>$product,
                    ]);
                }
            }
        }

        return result($fashion,200,'Created Fashion');

    }


    function deleteOrder(Request $request){

        if($request->orders){
            $orders = $request->orders;
            foreach ($orders as $order){
                Order::query()->where('id', $order)->delete();
            }
        }

        return result(true,200,'Deleted Order');
    }

}
