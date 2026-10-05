<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $fillable = ['user_id', 'total_amount', 'status'];

    // Relación: Una orden pertenece a un usuario (cliente)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relación: Una orden contiene muchos artículos (items)
    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    // Relación: Una orden tiene un solo registro de pago
    public function payment() {
        return $this->hasOne(Payment::class);
    }
}

