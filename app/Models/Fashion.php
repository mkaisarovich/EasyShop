<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fashion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'fashion_products', 'fashion_id', 'product_id');
    }

    public function images()
    {
        return $this->hasMany(FashionImage::class, 'fashion_id');
    }

    public function season()
    {
        return $this->belongsTo(ProductSeason::class, 'season_id');
    }

    public function style()
    {
        return $this->belongsTo(ProductStyle::class, 'style_id');
    }
}
