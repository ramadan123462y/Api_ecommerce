<?php

namespace App\Models\ApiFrontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [

        'order_id',
        'product_id',
        'count',
        'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {

        return $this->belongsTo(Product::class);
    }
}
