<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Categorie;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category',
        'list_price',
        'sale_price',
        'quantity',
    ];
    

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
 
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
