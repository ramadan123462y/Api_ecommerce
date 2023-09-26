<?php

namespace App\Models\ApiFrontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'stock',
        'categorie_id',
    ];
    public function categorie()
    {

        return $this->belongsTo(Categorie::class);
    }


    public function cartdetails()
    {

        return $this->hasMany(CartDetail::class);
    }
}
