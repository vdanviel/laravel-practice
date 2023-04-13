<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bought extends Model
{
    use HasFactory;

    protected $primaryKey = 'bought_id';

    protected $table = 'tb_boughts';

    protected $fillable = [
        "bought_user",
        "bought_product",
        "bought_qnt",
        "shopping_order_status"
    ];
}
