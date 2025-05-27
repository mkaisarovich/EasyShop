<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\CatalogCategory;
use App\Models\Gender;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index(Request $request){
        $data = CatalogCategory::query();

        if($request->has('search')){
            $data->where('name','like','%'.$request->search.'%');
        }

        $genders = Gender::query()->get();

        $data = $data->get();
        return view("admin.pages.super_admin.categories.index",compact("data","genders"));
    }

    public function create(Request $request){

        if($request->hasFile('image')){
            $photo =  uploadFile($request->image, "catalog_category/$request->name/image");
        }

        CatalogCategory::create([
            'name'=>$request->name,
            'image' =>$photo,
            'gender_id'=>$request->gender_id
        ]);


        return back()->withSuccess('Успешно');
    }

    public function edit(Request $request, CatalogCategory $category)
    {
        $category->fill($request->except(['image']));
        if($request->hasFile('image')){
            $category->image = uploadFile($request->photo, "catalog/$category->name/image");
        }

        $category->save();
        return back()->withSuccess('Каталог категорий успешно обновлен');
    }

    public function delete(CatalogCategory $category)
    {
        $category->delete();
        return back()->withSuccess('Каталог успешно удален');
    }

    function show(CatalogCategory $category){
//        return $catalog;
        $data = ProductCategory::query()->where('catalog_category_id',$category->id)->get();
        return view("admin.pages.super_admin.categories.category",compact("data",'category'));
    }

    public function createCatalog(Request $request){


        if($request->hasFile('image')){
            $photo =  uploadFile($request->image, "categories/$request->name/image");
        }


        ProductCategory::create([
            'name'=>$request->name,
            'catalog_category_id'=>$request->catalog_category_id,
            'image' =>$photo,
        ]);

        return back()->withSuccess('Успешно');
    }

    public function editCatalog(Request $request, ProductCategory $catalog)
    {
        $catalog->fill($request->except(['image']));
        if($request->hasFile('image')){
            $catalog->image = uploadFile($request->photo, "categories/$catalog->name/image");
        }

        $catalog->save();
        return back()->withSuccess('Успешно обновлен');
    }

    public function destroyCatalog(ProductCategory $catalog)
    {
        $catalog->delete();
        return back()->withSuccess('Успешно удален');
    }
}
