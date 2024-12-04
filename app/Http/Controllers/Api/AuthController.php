<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\ProductCategory;
use App\Models\Shop;
use App\Models\User;
use App\Models\SubCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    function register(Request $request){

        if($request->role == 'user'){

            if($request->service == 'google' or $request->service == 'apple'){
                $exists = User::query()->where('email',$request->email)->exists();
                if($exists){
                    return result(false,400,'Email already exists');
                }

                $dataArray = [
                    'name'=>$request->email,
                    'email'=>$request->email,
                    'password'=>bcrypt(12345),
                    'role'=>$request->role
                ];

                User::query()->create($dataArray);

                if (Auth::attempt(['email'=>$request->email,'password'=>12345])) {
                    $token = request()->user()->createToken('auth')->plainTextToken;
                    $token = explode('|', $token)[1];
                    $data = [
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                        'ttl' => 315569520,
                    ];
                    $res = array_merge($request->user()->toArray(), ['token' => $data]);
                }

                return result($res, 200, 'Успешно');

            }
            else{
                $exists = User::query()->where('email',$request->email)->exists();
                if($exists){
                    return result(false,400,'Email already exists');
                }
                $dataArray = [
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password),
                    'role'=>$request->role
                ];
            }



            User::query()->create($dataArray);




        }
        else{
            $dataArray = [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'city_id'=>$request->city_id,
                'role'=>'partner'
            ];

            $company = User::query()->create($dataArray);

            Shop::query()->create([
                'name'=>$request->name,
                'iin_bin'=>$request->iin_bin,
                'user_id'=>$company->id,
                'city_id'=>$request->city_id,
                'document'=>$request->document ?? null,
                'mall_id'=>$request->mall_id ?? null,
            ]);


        }

        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            $token = request()->user()->createToken('auth')->plainTextToken;
            $token = explode('|', $token)[1];
            $data = [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'ttl' => 315569520,
            ];
            $res = array_merge($request->user()->toArray(), ['token' => $data]);
            }

            return result($res, 200, 'Успешно');



    }

    function login(Request $request)
    {
        $data = [];

//        if($request->service == 'google' or $request->service = 'apple'){
//            if (Auth::attempt(['email' => $request->email, ])) {
//
//                $token = request()->user()->createToken('auth')->plainTextToken;
//                $token = explode('|', $token)[1];
//                $data = [
//                    'access_token' => $token,
//                    'token_type' => 'Bearer',
//                    'ttl' => 315569520,
//
//                ];
//            }
//
//            return $data != []
//                ? result( array_merge($request->user()->toArray(), ['token' => $data]),200,'Успешно')
//                : result(null,422,"Логин или пароль неправильный");
//        }



if ($request->service == 'google' || $request->service == 'apple') {
    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user) {
        $token = $user->createToken('auth')->plainTextToken;
        $token = explode('|', $token)[1];

        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'ttl' => 315569520,
        ];

        return result(array_merge($user->toArray(), ['token' => $data]), 200, 'Успешно');
    }

    return result(null, 422, "Логин или пароль неправильный");
}
        else{
            if (Auth::attempt(['email' => $request->email, 'password' => $request-> password])) {

                $token = request()->user()->createToken('auth')->plainTextToken;
                $token = explode('|', $token)[1];
                $data = [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'ttl' => 315569520,

                ];
            }

            return $data != []
                ? result( array_merge($request->user()->toArray(), ['token' => $data]),200,'Успешно')
                : result(null,422,"Логин или пароль неправильный");
        }





    }

    function logout(Request $request){

    }

    function getCity(Request $request){

        $data = City::query();
        if($request->search){
            $data->where('name', 'like', '%' . $request->search . '%');
        }

        $data = $data->get();

        return result($data,200,'Список городов');

    }


    function documents(){
        $data = [
            'privacy_policy'=>'https://skystoreez.com/src/html/pages/privacy-policy.html',
            'user-agreement'=>'https://skystoreez.com/src/html/pages/user-agreement.html',
        ];

        return result($data,200,'Document list');
    }

    function types(){
//        $json = '{
//    "hat": "шапка",
//    "t_shirt": "футболка",
//    "hoody": "худи",
//    "trousers": "штаны",
//    "bag": "сумка",
//    "shoes": "обувь",
//    "accessory": "аксессуар"
//}';

        $data = [
            ['name'=>'шапка','type'=>'hat'],
            ['name'=>'футболка','type'=>'t_shirt'],
            ['name'=>'худи','type'=>'hoody'],
            ['name'=>'штаны','type'=>'trousers'],
            ['name'=>'сумка','type'=>'bag'],
            ['name'=>'обувь','type'=>'shoes'],
            ['name'=>'аксессуар','type'=>'accessory'],
        ];

//        $translations = json_decode($json, true); // Decode JSON to an associative array
//        $data = ['hat', 't_shirt', 'hoody', 'trousers', 'bag', 'shoes', 'accessory'];
//        $translatedData = array_map(fn($item) => $translations[$item] ?? $item, $data); // Use the array for translation
//        $data = json_decode($json,true);
        return result($data, 200, 'Type list');

    }

    function category(Request $request){

        $type = $request->type;

        if($type == 'shoes'){
$data = ProductCategory::query()->whereIn('catalog_category_id',[2,5])->get();
        }elseif ($type == 'accessory'){
            $data = ProductCategory::query()->whereIn('catalog_category_id',[3,6])->get();
        }else{
            $data = ProductCategory::query()->whereIn('catalog_category_id',[1,4,7,8,9])->get();
        }

        return result($data,200,'Category list by type');

    }

    function subcatalog(Request $request)
    {
        $categoryId = $request->category_id;

        $data = SubCatalog::query()->where('category_id',$categoryId)->get();

        return result($data,200,'SubCategory list by category');
    }


}

