<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index(){
        $data = '';
        return view('admin.pages.super_admin.orders.index', compact('data'));
    }
}
