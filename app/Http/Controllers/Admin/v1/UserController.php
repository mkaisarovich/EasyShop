<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    function index(){

        $data = User::query()->where('role','user')->get();
        return view('admin.pages.super_admin.users.index', compact('data'));
    }
}
