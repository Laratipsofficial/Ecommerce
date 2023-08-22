<?php

namespace App\Models\Menu;

use App\Models\Discount\Discount;
use App\Models\Discount\DiscountItem;
use App\Models\Menus\Discounts\MenuItemDiscount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'number',
        'number_addition',
        'price',
        'menu_section_id',
    ];

    protected $appends = [
    ];


    public function menuSection()
    {
        return $this
            ->belongsTo(MenuSection::class);
    }

    public function discountItems()
    {
        return $this
            ->hasMany(DiscountItem::class);
    }

    public function getActiveDiscountItemAttribute()
    {
        return $this->discountItems->where('is_active', true)->sortByDesc('discount')->first();
    }

    public function getCurrentPriceAttribute(): float
    {
        return $this->active_discount_item ? $this->active_discount_item->discount : $this->price;
    }

    public function getDiscountAttribute(): float
    {
        // get the current price of the menu item
        // by setting the current price to the lowest price in the menu item discounts
        $discount = 0;

        // if the menu item has a active discount item
        if ($this->active_discount_item) {
            // set the current price to the price of the active discount item
            $discount = $this->active_discount_item->discount;
        }

        return $discount;
    }

    public function getFullNumberAttribute(): string
    {
        return "{$this->number}{$this->number_addition}";
    }
}
