<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = "orders";
    protected $primaryKey = "order_id";
    
    public function products() {
        return $this->hasMany("App\Models\ProductModel", "product_id");
    }
}
