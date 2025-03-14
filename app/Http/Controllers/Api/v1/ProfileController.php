<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\FavoriteSize;
use App\Models\Order;
use App\Models\OrderComplect;
use App\Models\Privacy;
use App\Models\Shop;
use App\Models\Size;
use App\Models\Subscribe;
use App\Models\User;
use App\Services\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    function index(){
        $user = User::query()
            ->with('city')
            ->find(auth()->user()->id)->toArray(); // Convert user to array
        $favoriteSizes = FavoriteSize::query()
            ->select('favorite_sizes.*','sizes.name')
            ->leftJoin('sizes', 'favorite_sizes.size_id', '=', 'sizes.id')
            ->where('favorite_sizes.user_id', auth()->user()->id)
            ->get();

//        $array = [
//            'user' => $data,
//            'favorite_sizes' => FavoriteSize::query()->where('user_id',auth()->user()->id)->get(),
//        ];
        return result( array_merge($user, ['favorite_sizes' => $favoriteSizes]),200,'Profile Details');
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
//        $avatar = null;
        if ($request->hasFile('avatar')) {
            $avatar = config('app.url') . '/storage/' . Storage::disk('public')->put("shops", $request->avatar) ?? null;
        }else{
            $exists = Shop::query()->select('avatar')->where('id',ShopService::shop()->id)->exists();
            if($exists){
                $avatar = Shop::query()->select('avatar')->where('id',ShopService::shop()->id)->value('avatar');
            }else{
                $avatar = null;
            }
        }


//        $document = null;
        if ($request->hasFile('document')) {
            $document = config('app.url') . '/storage/' . Storage::disk('public')->put("shops/document", $request->document) ?? null;
//            return $document;
        }

    Shop::query()->where('id',ShopService::shop()->id)->update([
        'whatsapp'=>$request->get('whatsapp'),
        'name'=>$request->get('name'),
        'iin_bin'=>$request->get('iin_bin'),
        'document'=>$document ?? null,
        'address'=>$request->get('address'),
        'mall_id'=>$request->get('mall_id'),
        'city_id'=>$request->get('city_id'),
        'phone_call'=>$request->get('phone_call'),
        'avatar'=>$avatar,
    ]);

        User::query()->where('id',ShopService::shop()->user_id)->update([
            'instagram'=>$request->get('instagram'),
        ]);

        return result(ShopService::shop(),200,'Profile Details Changed');
    }

    function favoriteSize(Request $request){
        $sizes = $request->sizes;

        if($sizes){
            FavoriteSize::query()->where('user_id',auth()->user()->id)->delete();
        }

        foreach ($sizes as $size){
            FavoriteSize::query()->create([
                'user_id'=>auth()->user()->id,
                'size_id'=>$size,
                'type'=>Size::query()->select('type')->where('id',$size)->value('type')
            ]);
        }

        return result(true,200,'Favorite Size changed');



    }


        function edit(Request $request)
    {
//        $request->validate([
//            'image' => 'required|image|max:5120', // Max 5MB
//        ]);
//

            if ($request->hasFile('image')) {
                $avatar = config('app.url') . '/storage/' . Storage::disk('public')->put("avatar/image", $request->image) ?? null;
            }else{
                $exists = User::query()->select('image')->where('id',auth()->id())->exists();
                if($exists){
                    $avatar = User::query()->select('image')->where('id',auth()->id())->value('image');
                }else{
                    $avatar = null;
                }
            }

//        dd($request->image);




        $array = [
            'name'=>$request->name,
            'email'=>$request->email,
            'city_id'=>$request->city_id,
//            'password'=>bcrypt($request->password),
            'image'=>  $avatar ,
            'phone'=>$request->phone,
            'address' => $request->address
        ];

        User::query()->where('id',auth()->user()->id)->update($array);

        return result(auth()->user(),200,'Profile Details Changed');
    }
    
    
    function orders(Request $request){
        $status = $request->status;
        $type = $request->type;
        if($type == 'product'){
            switch ($status) {
                case 'wait':
//                    $data = Order::query()
//                        ->with('product.images','product.season',
//                            'product.style','product.structure','product.catalog_category','product.product_category','product.sizes')
//                        ->where('type','product')
//                        ->where('status_id', 1)
//                        ->where('user_id', auth()->id())
//                        ->get();

                    $data = OrderComplect::query()->
                    where('type',$type)
                        ->with([
                            'order_unions' => function ($query) {
                                $query->with([
                                    'product.images',
                                    'product.season',
                                    'product.style',
                                    'product.structure',
                                    'product.catalog_category',
                                    'product.product_category',
                                    'product.sizes',
                                    'user',
                                    'shop'
                                ])
                                    ->where('type', 'product')
                                    ->where('status_id', 1)
                                    ->where('user_id', auth()->user()->id);
                            }
                        ])
                        ->get();

                    $data = $data->filter(function ($item) {
                        // If the order_unions relationship is empty, exclude the item.
                        return $item->order_unions->isNotEmpty();
                    });

                    $data = $data->values();

// If no data remains after filtering, set $data to an empty array.
                    if ($data->isEmpty()) {
                        $data = [];
                    }


                    break;
                case 'accept':
//                    $data = Order::query()
//                        ->with('product.images','product.season',
//                            'product.style','product.structure','product.catalog_category','product.product_category','product.sizes')
//                        ->where('type','product')
//                        ->where('status_id', 2)
//                        ->where('user_id', auth()->id())
//                        ->get();

                    $data = OrderComplect::query()->
                    where('type',$type)
                        ->with([
                            'order_unions' => function ($query) {
                                $query->with([
                                    'product.images',
                                    'product.season',
                                    'product.style',
                                    'product.structure',
                                    'product.catalog_category',
                                    'product.product_category',
                                    'product.sizes',
                                    'user',
                                    'shop'
                                ])
                                    ->where('type', 'product')
                                    ->where('status_id', 2)
                                    ->where('user_id', auth()->user()->id);
                            }
                        ])
                        ->get();

                    $data = $data->filter(function ($item) {
                        // If the order_unions relationship is empty, exclude the item.
                        return $item->order_unions->isNotEmpty();
                    });

                    $data = $data->values();

// If no data remains after filtering, set $data to an empty array.
                    if ($data->isEmpty()) {
                        $data = [];
                    }

                    break;
                case 'ready':
//                    $data = Order::query()
//                        ->with('product.images','product.season',
//                            'product.style','product.structure','product.catalog_category','product.product_category','product.sizes')
//                        ->where('type','product')
//                        ->where('status_id', 3)
//                        ->where('user_id', auth()->id())
//                        ->get();

                    $data = OrderComplect::query()->
                    where('type',$type)
                        ->with([
                            'order_unions' => function ($query) {
                                $query->with([
                                    'product.images',
                                    'product.season',
                                    'product.style',
                                    'product.structure',
                                    'product.catalog_category',
                                    'product.product_category',
                                    'product.sizes',
                                    'user',
                                    'shop'
                                ])
                                    ->where('type', 'product')
                                    ->where('status_id', 3)
                                    ->where('user_id', auth()->user()->id);
                            }
                        ])
                        ->get();

                    $data = $data->filter(function ($item) {
                        // If the order_unions relationship is empty, exclude the item.
                        return $item->order_unions->isNotEmpty();
                    });

                    $data = $data->values();

// If no data remains after filtering, set $data to an empty array.
                    if ($data->isEmpty()) {
                        $data = [];
                    }


                    break;
                case 'completed':
//                    $data = Order::query()
//                        ->with('product.images','product.season',
//                            'product.style','product.structure','product.catalog_category','product.product_category','product.sizes')
//                        ->where('type','product')
//                        ->where('status_id', 4)
//                        ->where('user_id', auth()->id())
//                        ->get();


                    $data = OrderComplect::query()->
                    where('type',$type)
                        ->with([
                            'order_unions' => function ($query) {
                                $query->with([
                                    'product.images',
                                    'product.season',
                                    'product.style',
                                    'product.structure',
                                    'product.catalog_category',
                                    'product.product_category',
                                    'product.sizes',
                                    'user',
                                    'shop'
                                ])
                                    ->where('type', 'product')
                                    ->where('status_id', 4)
                                    ->where('user_id', auth()->user()->id);
                            }
                        ])
                        ->get();

                    $data = $data->filter(function ($item) {
                        // If the order_unions relationship is empty, exclude the item.
                        return $item->order_unions->isNotEmpty();
                    });

                    $data = $data->values();

// If no data remains after filtering, set $data to an empty array.
                    if ($data->isEmpty()) {
                        $data = [];
                    }


                    break;
                default;
            }
        }
        else{
            switch ($status) {
                case 'wait':
                    $data = Order::query()
                        ->with('fashion.products.images','fashion.products.season','fashion.products.style',
                            'fashion.products.structure','fashion.products.catalog_category','fashion.style','fashion.season',
                            'fashion.products.product_category')
                        ->where('type','fashion')
                        ->where('status_id', 1)
                        ->where('user_id', auth()->id())
                        ->get();
                    break;
                case 'accept':
                    $data = Order::query()
                        ->with('fashion.products.images','fashion.products.season','fashion.products.style',
                            'fashion.products.structure','fashion.products.catalog_category','fashion.style','fashion.season',
                            'fashion.products.product_category')
                        ->where('type','fashion')
                        ->where('status_id', 2)
                        ->where('user_id', auth()->id())
                        ->get();
                    break;
                case 'ready':
                    $data = Order::query()
                        ->with('fashion.products.images','fashion.products.season','fashion.products.style',
                            'fashion.products.structure','fashion.products.catalog_category','fashion.style','fashion.season',
                            'fashion.products.product_category')
                        ->where('type','fashion')
                        ->where('status_id', 3)
                        ->where('user_id', auth()->id())
                        ->get();
                    break;
                case 'completed':
                    $data = Order::query()
                        ->with('fashion.products.images','fashion.products.season','fashion.products.style',
                            'fashion.products.structure','fashion.products.catalog_category','fashion.style','fashion.season',
                            'fashion.products.product_category')
                        ->where('type','fashion')
                        ->where('status_id', 4)
                        ->where('user_id', auth()->id())
                        ->get();
                    break;
                default;
            }
        }

        return result($data,200,'Orders List');
    }
    

    function delete(){
        auth()->user()->delete();
        return result(true,200,'Profile Deleted');
    }


}
