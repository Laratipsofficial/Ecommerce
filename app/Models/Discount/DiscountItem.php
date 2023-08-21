<?php

namespace App\Models\Discount;

use App\Models\Menu\MenuItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountItem extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'discount',
        'discount_id',
        'menu_item_id',
    ];

    protected $appends = [
        'name',
        'price',
        'discounted_price',
        'is_active',
        'parent'
    ];

    public function parent()
    {
        return $this
            ->belongsTo(Discount::class);
    }

    public function getParentAttribute()
    {
        return $this->parent()->first();
    }

    public function menuItem()
    {
        return $this
            ->belongsTo(MenuItem::class);
    }

    public function getNameAttribute()
    {
        return $this->menuItem->name;
    }

    public function getPriceAttribute()
    {
        return $this->menuItem->price;
    }

    public function getDiscountedPriceAttribute()
    {
        return $this->menuItem->price - $this->discount;
    }

    public function getIsActiveAttribute()
    {
        return true;
    }
}
