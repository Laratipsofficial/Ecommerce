<?php

namespace App\Models\Tables;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'table_id',
        'order_id',
        'comment',
        'starts_at',
        'ends_at',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeTable($query, $tableId)
    {
        return $query->where('table_id', $tableId);
    }
}
