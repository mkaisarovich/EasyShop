<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    function index()
    {
        $data = City::all();
        return view('admin.pages.super_admin.city.index', compact('data'));
    }

    function create(Request $request){
        City::query()->create($request->all());
        return back()->withSuccess('Успешно');
    }

    function edit(City $city,Request $request)
    {
        $city->update($request->all());
        $city->save();
        return back()->withSuccess('Успешно');
    }

    function delete(City $city)
    {
        $city->delete();
        return back()->withSuccess('Успешно');
    }
}
