<?php

namespace App\Models\ApiFrontend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id'
    ];
    public function user()
    {

        return $this->belongsTo(User::class);
    }
    public function cartdetails()
    {

        return $this->hasMany(CartDetail::class);
    }
}
