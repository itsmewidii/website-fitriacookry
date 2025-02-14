<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'orders';
    protected $primaryKey = "id";
    protected $fillable = [
        'user_id',
        'name',
        'shipping_price',
        'shipping_code',
        'shipping',
        'no_whatsapp',
        'email',
        'total_qty',
        'total_price',
        'address',
        'status',
        'proof_transfer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_carts()
    {
        return $this->hasMany(OrderCart::class, 'order_id');
    }

}
