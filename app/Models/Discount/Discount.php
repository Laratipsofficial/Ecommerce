<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'starts_at',
        'ends_at',
    ];

    protected $appends = [
        'is_active',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function discountItems()
    {
        return $this
            ->hasMany(DiscountItem::class);
    }

    public function getIsActiveAttribute()
    {
        return $this->starts_at <= now() && $this->ends_at >= now();
    }
}
