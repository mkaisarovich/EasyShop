<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{

    function index(){
        return view('admin.pages.super_admin.main.index');
    }
}
