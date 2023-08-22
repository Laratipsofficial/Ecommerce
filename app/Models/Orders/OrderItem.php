<?php

namespace App\Models\Orders;

use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuSideItem;
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
        'comment',
        'discount'
    ];

    protected $appends = [
        'menu_item_name',
        'menu_side_item_name',
        'total_price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function menuSideItem()
    {
        return $this->belongsTo(MenuSideItem::class);
    }

    public function getMenuItemNameAttribute()
    {
        $menuItem = $this->menuItem()->first();

        return $menuItem->name;
    }

    public function getMenuSideItemNameAttribute()
    {
        $menuSideItem = $this->menuSideItem()->first();

        return $menuSideItem->name;
    }

    public function getTotalPriceAttribute()
    {
        return $this->price * $this->quantity;
    }

    // query all the comments and order them by most used
    // return a list of comments
    public static function getComments()
    {
        return OrderItem::query()
            ->select('comment')
            ->groupBy('comment')
            ->orderByRaw('COUNT(*) DESC')
            ->get()
            ->pluck('comment');
    }
}
