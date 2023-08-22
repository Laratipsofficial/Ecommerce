<?php

namespace App\Models\Orders;

use App\Models\Tables\Table;
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
        'table_id',
        'item_count',
    ];

    protected $appends = [
        'total_price'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function type()
    {
        return $this->belongsTo(OrderType::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->items->sum('total_price');
    }

    public function getItemCountAttribute()
    {
        return $this->items->count();
    }
}
