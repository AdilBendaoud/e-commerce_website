<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\ShippingAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'shipping_addresses_id',
        'order_date',
        'total'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shipping_addresses(){
        return $this->belongsTo(ShippingAddress::class);
    }
}
