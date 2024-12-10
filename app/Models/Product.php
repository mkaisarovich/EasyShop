<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function season()
    {
        return $this->belongsTo(ProductSeason::class, 'season_id');
    }

    public function structure()
    {
        return $this->belongsTo(ProductStructure::class, 'struture_id');
    }

    public function subcatalog()
    {
        return $this->belongsTo(SubCatalog::class, 'subcatalog_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function style()
    {
        return $this->belongsTo(ProductStyle::class, 'style_id');
    }

    public function catalog_category()
    {
        return $this->belongsTo(CatalogCategory::class, 'catalog_category_id');
    }

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

//    public function images()
//    {
//        return $this->hasMany(ProductImage::class, 'product_id');
//    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    public function fashions()
    {
        return $this->belongsToMany(Fashion::class, 'fashion_products', 'product_id', 'fashion_id');
    }
}
