<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;
    protected $table = 'tb_shoppings';
    protected $primaryKey = 'shopping_id';
    public $timestamps = false;

    protected $fillable = [
        'shopping_cart',
        'shopping_product',
        'shopping_qnt'
    ];


    public function scopeByCart($query, $idcart){

        return $query->where('shopping_cart', $idcart)->get();

    }
}
