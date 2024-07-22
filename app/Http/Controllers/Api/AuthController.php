<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    function register(Request $request){

        if($request->role == 'user'){
            $dataArray = [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'role'=>$request->role
            ];

            User::query()->create($dataArray);


        }else{
            $dataArray = [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'city_id'=>$request->city_id
            ];

            $company = User::query()->create($dataArray);

            Shop::query()->create([
                'name'=>$request->name,
                'iin_bin'=>$request->iin_bin,
                'user_id'=>$company->id,
                'city_id'=>$request->city_id
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
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

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

}

