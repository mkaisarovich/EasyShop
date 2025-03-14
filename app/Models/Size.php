<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class, 'size_id');
    }
}
