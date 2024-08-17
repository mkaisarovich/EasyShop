<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ProductSeason;
use App\Models\ProductSize;
use App\Models\ProductStructure;
use App\Models\ProductStyle;
use App\Models\Size;
use Illuminate\Http\Request;

class FilterController extends Controller
{

    function colors()
    {
        $data = Color::get();
        return view('admin.pages.super_admin.filters.colors', compact('data'));
    }

    function sizes()
    {
        $data = Size::get();
        return view('admin.pages.super_admin.filters.sizes', compact('data'));
    }

    function seasons()
    {
        $data = ProductSeason::get();
        return view('admin.pages.super_admin.filters.seasons', compact('data'));

    }

    function structures()
    {
        $data = ProductStructure::get();
        return view('admin.pages.super_admin.filters.structures', compact('data'));
    }

    function styles()
    {
        $data = ProductStyle::get();
        return view('admin.pages.super_admin.filters.styles', compact('data'));
    }





    function colorsCreate(Request $request){
        Color::query()->create(['name'=>$request->name]);
        return back()->withSuccess('Успешно');
    }

    function sizesCreate(Request $request){
        Size::query()->create([
            'name'=>$request->name,
            'type'=>$request->type == 'Обувь' ? 'shoes' : 'clothes'
        ]);

        return back()->withSuccess('Успешно');
    }

    function seasonsCreate(Request $request)
    {
        ProductSeason::query()->create(['name'=>$request->name]);
        return back()->withSuccess('Успешно');
    }

    function structuresCreate(Request $request){
        ProductStructure::query()->create(['name'=>$request->name]);
        return back()->withSuccess('Успешно');
    }

    function stylesCreate(Request $request)
    {
        ProductStyle::query()->create(['name'=>$request->name]);
        return back()->withSuccess('Успешно');
    }



    function colorsEdit(Color $color,Request $request){
        $color->name = $request->name;
        $color->save();
        return back()->withSuccess('Успешно');
    }

    function sizesEdit(Request $request,Size $size){

            $size->name = $request->name;
            $size->type = $request->type == 'Обувь' ? 'shoes' : 'clothes';
            $size->save();

        return back()->withSuccess('Успешно');
    }

    function seasonsEdit(ProductSeason $season,Request $request)
    {
        $season->name = $request->name;
        $season->save();
        return back()->withSuccess('Успешно');
    }

    function structuresEdit(ProductStructure $structure,Request $request){
        $structure->name = $request->name;
        $structure->save();
        return back()->withSuccess('Успешно');
    }

    function stylesEdit(ProductStyle $style,Request $request)
    {
       $style->name = $request->name;
       $style->save();
        return back()->withSuccess('Успешно');
    }





    function colorsDelete(Color $color)
    {
        $color->delete();
        return back()->withSuccess('Успешно');
    }

    function sizesDelete(Size $size)
    {
        $size->delete();
        return back()->withSuccess('Успешно');
    }

    function seasonsDelete(ProductSeason $season){
        $season->delete();
        return back()->withSuccess('Успешно');
    }

    function structuresDelete(ProductStructure $structure){
        $structure->delete();
        return back()->withSuccess('Успешно');
    }

    function stylesDelete(ProductStyle $style){
        $style->delete();
        return back()->withSuccess('Успешно');
    }



}
