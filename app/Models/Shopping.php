<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;
    protected $table = 'tb_shoppings';
    public $timestamps = false;


    public function scopeByCart($query, $idcart){

        return $query->where('shopping_cart', $idcart)->get();

    }
}
