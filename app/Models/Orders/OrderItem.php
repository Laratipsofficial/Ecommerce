<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'table_round',
        'order_id',
        'menu_item_id',
        'price',
        'quantity',
        'menu_side_item_id',
    ];
}
