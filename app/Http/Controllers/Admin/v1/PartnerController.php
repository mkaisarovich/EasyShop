<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    function index(){

        $data = User::query()->where('role','partner')->get();
        return view('admin.pages.super_admin.partners.index', compact('data'));
    }
}
