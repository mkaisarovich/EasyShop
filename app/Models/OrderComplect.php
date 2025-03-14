<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderComplect extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order_unions()
    {
        return $this->hasMany(Order::class, 'order_complect_id');
    }
}
