<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    function about_us(){
        $data = '';
        return view('admin.pages.super_admin.settings.about_us',compact('data'));
    }

    function privacy(){

        $data = '';
        return view('admin.pages.super_admin.settings.privacy',compact('data'));

    }
}
