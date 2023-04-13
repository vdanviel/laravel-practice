<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    //nome da tabela
    protected $table = 'tb_orders';

    protected $fillable = [
        "order_status",
        "order_total_price",
        "order_session_id"
    ];
}
