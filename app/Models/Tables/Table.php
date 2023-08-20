<?php

namespace App\Models\Tables;

use App\Models\Orders\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'number',
        'current_reservation_id',
    ];

    public function attentions()
    {
        return $this
            ->hasMany(Attention::class);
    }

    public function orders()
    {
        return $this
            ->hasMany(Order::class);
    }

    public function reservations()
    {
        return $this
            ->hasMany(Reservation::class);
    }

}
