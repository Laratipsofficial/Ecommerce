<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'status_id',
        'type_id',
        'price',
        'discount',
        'comment',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
