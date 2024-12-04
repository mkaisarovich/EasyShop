<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'selled_id');
    }

    public function fashion()
    {
        return $this->belongsTo(Fashion::class, 'selled_id');
    }
}
