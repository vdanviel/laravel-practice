<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $timestamps = false;
    //nome da tabela
    protected $table = 'tb_carts';

    public function scopeByUser($query, $iduser){
        return $query->where('cart_user', $iduser)->first();
    }
}
