<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\CatalogCategory;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSeason;
use App\Models\ProductStructure;
use App\Models\ProductStyle;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    function index(Request $request,CatalogCategory $catalog)
    {

        $catalog = $catalog->id;
        $shopId = $request->shop_id;
        $type = $request->type;
        $sort_price = $request->sort_price;

      if($type == 0){
          $data = Product::query()->with('images','sizes')->where('shop_id',$shopId)->where('catalog_category_id',$catalog);
      }
         else{
             $data = Product::query()->with('images','sizes')->where('shop_id',$shopId)->where('catalog_category_id',$catalog)->where('product_category_id',$type);
         }

         if($sort_price){
             $data->orderBy('products.price',$sort_price);
         }



         $data = $data->get();

         return result($data,200,'Product list');


    }

    function getCategory()
    {
        $data = ProductCategory::all();

        return result($data,200,'Category list');

    }

    function show(CatalogCategory $catalog,Product $product)
    {

      $data = Product::query()->with('images','sizes')->where('products.id',$product->id)->get();

          return result($data,200,'Product info');

    }


    function filter(){

        $colors = Color::query()->get();
        $sizes = Size::query()->get();
        $structure = ProductStructure::query()->get();
        $style = ProductStyle::query()->get();
        $season = ProductSeason::query()->get();
        $data = [
            'colors' => $colors,
            'sizes' => $sizes,
            'structure' => $structure,
            'style' => $style,
            'season' => $season
        ];

        return result($data,200,'Filter list');


    }

}
