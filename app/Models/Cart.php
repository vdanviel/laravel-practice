<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    //public $timestamps = false;

    protected $primaryKey = 'cart_id';
    //nome da tabela
    protected $table = 'tb_carts';

    protected $fillable = [
        'cart_user',
    ];

    public function scopeByUser($query, $iduser){
        return $query->where('cart_user', $iduser)->first();
    }
}
