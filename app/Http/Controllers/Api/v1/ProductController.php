<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\CatalogCategory;
use App\Models\Color;
use App\Models\FavoriteSize;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSeason;
use App\Models\ProductStructure;
use App\Models\ProductStyle;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    function index(Request $request,CatalogCategory $catalog)
    {

        $catalog = $catalog->id;
        $shopId = $request->shop_id;
        $type = $request->type;
        $sort_price = $request->sort_price;
        $existsFavoriteSize = FavoriteSize::query()->where('user_id',auth()->user()->id)->exists();
        $seasonId = $request->season_id;
        $styleId = $request->style_id;
        $priceFrom = $request->price_from;
        $priceTo = $request->price_to;
        $discount = $request->discount;

      if($request->sizes){
          if($type == 0){
              //$request->sizes is [1,3,4]

              $data = Product::query()
                  ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                      'product_styles.name as style_name','product_structures.name as structure_name',
                      'product_seasons.name as season_name','catalog_categories.name as catalog_category_name')
                  ->with('images','sizes')
                  ->where('products.shop_id',$shopId)
                  ->where('products.catalog_category_id',$catalog)
                  ->leftJoin('favorites', function ($join) {
                      $join->on('favorites.favorite_id', '=', 'products.id')
                          ->where('favorites.type', '=', 'product')
                          ->where('favorites.user_id', '=', auth()->user()->id);
                  })
                  ->whereIn('products.size_id',$request->sizes)
//                  ->where('products.count','>',0)
                  ->leftJoin('product_styles','products.style_id','=','product_styles.id')
                  ->leftJoin('product_structures','products.struture_id','=','product_structures.id')
                  ->leftJoin('product_seasons','products.season_id','=','product_seasons.id')
                  ->leftJoin('catalog_categories','products.catalog_category_id','=','catalog_categories.id')
                  ->leftJoin('product_categories','products.product_category_id','=','product_categories.id');

              if($discount){
                  $data->whereNotNull('products.discount_price');
              }

          }
          else{
              $data = Product::query()
                  ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                      'product_styles.name as style_name','product_structures.name as structure_name',
                      'product_seasons.name as season_name','catalog_categories.name as catalog_category_name')
                  ->with('images','sizes')
                  ->where('products.shop_id',$shopId)
                  ->where('products.catalog_category_id',$catalog)
                  ->where('products.product_category_id',$type)
//                  ->where('products.count','>',0)
                  ->leftJoin('favorites', function ($join) {
                      $join->on('favorites.favorite_id', '=', 'products.id')
                          ->where('favorites.type', '=', 'product')
                          ->where('favorites.user_id', '=', auth()->user()->id);
                  })
                  ->leftJoin('product_styles','products.style_id','=','product_styles.id')
                  ->leftJoin('product_structures','products.struture_id','=','product_structures.id')
                  ->leftJoin('product_seasons','products.season_id','=','product_seasons.id')
                  ->leftJoin('catalog_categories','products.catalog_category_id','=','catalog_categories.id')
                  ->leftJoin('product_categories','products.product_category_id','=','product_categories.id')
              ;
              if($discount){
                  $data->whereNotNull('products.discount_price');
              }

          }
      }
      else{
          if($existsFavoriteSize){

              $sizes = FavoriteSize::query()
                  ->where('user_id',auth()->user()->id)
                  ->pluck('id')
                  ->toArray();

              if($type == 0){
                  $data = Product::query()
                      ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                          'product_styles.name as style_name','product_structures.name as structure_name',
                          'product_seasons.name as season_name','catalog_categories.name as catalog_category_name')
                      ->with('images','sizes')
                      ->where('products.shop_id',$shopId)
                      ->where('products.catalog_category_id',$catalog)
//                      ->where('products.count','>',0)
                      ->whereIn('product_sizes.size_id',$sizes)
                      ->leftJoin('favorites', function ($join) {
                          $join->on('favorites.favorite_id', '=', 'products.id')
                              ->where('favorites.type', '=', 'product')
                              ->where('favorites.user_id', '=', auth()->user()->id);
                      })
                      ->leftJoin('product_sizes','product_sizes.product_id','=','products.id')
                      ->leftJoin('product_styles','products.style_id','=','product_styles.id')
                      ->leftJoin('product_structures','products.struture_id','=','product_structures.id')
                      ->leftJoin('product_seasons','products.season_id','=','product_seasons.id')
                      ->leftJoin('catalog_categories','products.catalog_category_id','=','catalog_categories.id')
                      ->leftJoin('product_categories','products.product_category_id','=','product_categories.id');
                  if($discount){
                      $data->whereNotNull('products.discount_price');
                  }

              }
              else{
                  $data = Product::query()
                      ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                          'product_styles.name as style_name','product_structures.name as structure_name',
                          'product_seasons.name as season_name','catalog_categories.name as catalog_category_name')
                      ->with('images','sizes')
                      ->where('products.shop_id',$shopId)
                      ->where('products.catalog_category_id',$catalog)
                      ->where('products.product_category_id',$type)
//                      ->where('products.count','>',0)
                      ->leftJoin('favorites', function ($join) {
                          $join->on('favorites.favorite_id', '=', 'products.id')
                              ->where('favorites.type', '=', 'product')
                              ->where('favorites.user_id', '=', auth()->user()->id);
                      })
                      ->whereIn('product_sizes.size_id',$sizes)
                      ->leftJoin('product_sizes','product_sizes.product_id','=','products.id')
                      ->leftJoin('product_styles','products.style_id','=','product_styles.id')
                      ->leftJoin('product_structures','products.struture_id','=','product_structures.id')
                      ->leftJoin('product_seasons','products.season_id','=','product_seasons.id')
                      ->leftJoin('catalog_categories','products.catalog_category_id','=','catalog_categories.id')
                      ->leftJoin('product_categories','products.product_category_id','=','product_categories.id')
                  ;
                  if($discount){
                      $data->whereNotNull('products.discount_price');
                  }

              }
          }
          else{
              if($type == 0){
                  $data = Product::query()
                      ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                          'product_styles.name as style_name','product_structures.name as structure_name',
                          'product_seasons.name as season_name','catalog_categories.name as catalog_category_name')
                      ->with('images','sizes')
                      ->where('products.shop_id',$shopId)
                      ->where('products.catalog_category_id',$catalog)
//                      ->where('products.count','>',0)
                      ->leftJoin('favorites', function ($join) {
                          $join->on('favorites.favorite_id', '=', 'products.id')
                              ->where('favorites.type', '=', 'product')
                              ->where('favorites.user_id', '=', auth()->user()->id);
                      })
                      ->leftJoin('product_styles','products.style_id','=','product_styles.id')
                      ->leftJoin('product_structures','products.struture_id','=','product_structures.id')
                      ->leftJoin('product_seasons','products.season_id','=','product_seasons.id')
                      ->leftJoin('catalog_categories','products.catalog_category_id','=','catalog_categories.id')
                      ->leftJoin('product_categories','products.product_category_id','=','product_categories.id');
                  if($discount){
                      $data->whereNotNull('products.discount_price');
                  }


              }
              else{
                  $data = Product::query()
                      ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
                          'product_styles.name as style_name','product_structures.name as structure_name',
                          'product_seasons.name as season_name','catalog_categories.name as catalog_category_name')
                      ->with('images','sizes')
                      ->where('products.shop_id',$shopId)
                      ->where('products.catalog_category_id',$catalog)

//                      ->where('products.count','>',0)
                      ->where('products.product_category_id',$type)
                      ->leftJoin('favorites', function ($join) {
                          $join->on('favorites.favorite_id', '=', 'products.id')
                              ->where('favorites.type', '=', 'product')
                              ->where('favorites.user_id', '=', auth()->user()->id);
                      })
                      ->leftJoin('product_styles','products.style_id','=','product_styles.id')
                      ->leftJoin('product_structures','products.struture_id','=','product_structures.id')
                      ->leftJoin('product_seasons','products.season_id','=','product_seasons.id')
                      ->leftJoin('catalog_categories','products.catalog_category_id','=','catalog_categories.id')
                      ->leftJoin('product_categories','products.product_category_id','=','product_categories.id')
                  ;
                  if($discount){
                      $data->whereNotNull('products.discount_price');
                  }

              }
          }
        }









         if($sort_price){
             $data->orderBy('products.price',$sort_price);
         }
         if($request->subcatalog_id){
             $data->where('products.subcatalog_id',$request->subcatalog_id);
         }
         if($styleId){
             $data->where('products.style_id',$styleId);
         }
         if($seasonId){
             $data->where('products.season_id',$seasonId);
         }
         if($priceFrom and $priceTo){
             $data->whereBetween('products.price',[$priceFrom,$priceTo]);
         }
        if($request->color_id){
            $data->where('products.color_id',$request->color_id);
        }



         $data = $data->get();

        $data->transform(function ($item) {
            $item->style = [
                'id' => $item->style_id,
                'name' => $item->style_name,
            ];
            unset($item->style_id, $item->style_name);

            $item->structure = [
                'id' => $item->struture_id,
                'name' => $item->structure_name,
            ];
            unset($item->struture_id, $item->structure_name);

            $item->season = [
                'id' => $item->season_id,
                'name' => $item->season_name,
            ];
            unset($item->season_id, $item->season_name);

            $item->catalog_category = [
                'id' => $item->catalog_category_id,
                'name' => $item->catalog_category_name,
            ];
            unset($item->catalog_category_id, $item->catalog_category_name);

            $item->product_category = [
                'id' => $item->product_category_id,
                'name' => $item->product_category_name,
            ];
            unset($item->product_category_id, $item->product_category_name);

            return $item;
        });

         return result($data,200,'Product list');


    }

    function getCategory(Request $request)
    {
        $data = ProductCategory::query()->where('catalog_category_id',$request->catalog_category_id)->get();

        return result($data,200,'Category list');

    }

    function show(CatalogCategory $catalog,Product $product)
    {

      $data = Product::query()
          ->select('products.*',DB::raw('(favorites.id IS NOT NULL) as is_favorite'),
              'product_styles.name as style_name','product_structures.name as structure_name',
          'product_seasons.name as season_name','catalog_categories.name as catalog_category_name')
          ->with('images','sizes')
          ->where('products.id',$product->id)
          ->leftJoin('favorites', function ($join) {
              $join->on('favorites.favorite_id', '=', 'products.id')
                  ->where('favorites.type', '=', 'product')
                  ->where('favorites.user_id', '=', auth()->user()->id);
          })
          ->leftJoin('product_styles','products.style_id','=','product_styles.id')
          ->leftJoin('product_structures','products.struture_id','=','product_structures.id')
          ->leftJoin('product_seasons','products.season_id','=','product_seasons.id')
          ->leftJoin('catalog_categories','products.catalog_category_id','=','catalog_categories.id')
          ->leftJoin('product_categories','products.product_category_id','=','product_categories.id')
          ->get();

        $data->transform(function ($item) {
            $item->style = [
                'id' => $item->style_id,
                'name' => $item->style_name,
            ];
            unset($item->style_id, $item->style_name);

            $item->structure = [
                'id' => $item->struture_id,
                'name' => $item->structure_name,
            ];
            unset($item->struture_id, $item->structure_name);

            $item->season = [
                'id' => $item->season_id,
                'name' => $item->season_name,
            ];
            unset($item->season_id, $item->season_name);

            $item->catalog_category = [
                'id' => $item->catalog_category_id,
                'name' => $item->catalog_category_name,
            ];
            unset($item->catalog_category_id, $item->catalog_category_name);

            $item->product_category = [
                'id' => $item->product_category_id,
                'name' => $item->product_category_name,
            ];
            unset($item->product_category_id, $item->product_category_name);

            return $item;
        });

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

    function basket(Request $request,CatalogCategory $catalog,Product $product)
    {
        Basket::query()->create([
            'product_id'=>$product->id,
            'shop_id'=>$product->shop_id,
            'user_id'=>auth()->user()->id,
            'type'=>'product',
            'product_size'=>$request->product_size
        ]);

        return result(true,200,'Успешно добавился в корзину');
    }

  

}
