<?php

namespace App\Models\ApiFrontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    protected $fillable = [

        'cart_id',
        'product_id',
        'count',
    ];
    public function cart()
    {

        return $this->belongsTo(Cart::class);
    }
    public function product()
    {

        return $this->belongsTo(Product::class);
    }
}
