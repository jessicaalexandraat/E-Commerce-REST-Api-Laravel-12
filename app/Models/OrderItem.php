<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model

    {
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Relación: Este detalle de orden hace referencia a un producto del catálogo
    public function product() {
        return $this->belongsTo(Product::class);
    }

}
