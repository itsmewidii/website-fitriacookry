<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OrderCart extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'order_carts';
    protected $primaryKey = "id";
    protected $fillable = [
        'cart_id',
        'order_id',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
