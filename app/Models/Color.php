<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function productColors()
    {
        return $this->hasMany(ProductColor::class, 'color_id');
    }

    
}
