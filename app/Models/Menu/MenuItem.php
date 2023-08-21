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
        'full_number',
        'discount',
        'current_price',
        'active_discount_item',
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
        // first retrieve all the discounts that are active
        // and have a discount item with the menu item id
        $discounts = Discount::query()
            ->where('starts_at', '<=', now())
            ->where('ends_at', '>=', now())
            ->whereHas('discountItems', function ($query) {
                $query->where('menu_item_id', $this->id);
            })
            ->get();

        // if there are no active discounts with a discount item with the menu item id
        if ($discounts->isEmpty()) {
            // return null
            return null;
        }

        // return the discount item with the highest discount
        $discount = $discounts->sortByDesc('discount')->first();

        // return the discount item with menu item id and the discount item discount
        return DiscountItem::query()
            ->where('menu_item_id', $this->id)
            ->where('discount', $discount->discount)
            ->first();
    }

    public function getCurrentPriceAttribute(): float
    {
        // get the current price of the menu item
        // by setting the current price to the lowest price in the menu item discounts
        $currentPrice = $this->price;

        // if the menu item has a active discount item
        if ($this->active_discount_item) {
            // set the current price to the price of the active discount item
            $currentPrice = $this->active_discount_item->discount;
        }

        return $currentPrice;
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
