<?php

namespace App\Models\Menu;

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
        'current_price',
    ];


    public function menuSection()
    {
        return $this
            ->belongsTo(MenuSection::class);
    }

    public function getCurrentPriceAttribute(): float
    {
        // get the current price of the menu item
        // by setting the current price to the lowest price in the menu item discounts
        $currentPrice = $this->price;

        $this->menuItemDiscounts->each(function (DiscountItem $menuItemDiscount) use (&$currentPrice) {
            if ($menuItemDiscount->price < $currentPrice) {
                $currentPrice = $menuItemDiscount->price;
            }
        });

        return $currentPrice;
    }

    public function getFullNumberAttribute(): string
    {
        return "{$this->number}{$this->number_addition}";
    }
}
