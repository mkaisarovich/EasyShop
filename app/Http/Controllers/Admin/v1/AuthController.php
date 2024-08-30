<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    function login(Request $request){
        if ($request->method() == 'POST') {

            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            $email = $request->email;

            if (Auth::attempt(['email' => $email,'password' => $request->password])) {
                if (auth()->user()->role == 'admin'){
                    return redirect()->route('admin.super_admin.main.');
                }
            }else{
                return back()->withErrors('Неправильная почта или пароль');
            }

        }
        else{
            return view('admin.pages.login');
        }
    }

    function register(Request $request){

    }


    function logout (Request $request)
    {
        session()->flush();
        return redirect()->route('admin.login');
    }


}
