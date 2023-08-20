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

    public function discount()
    {
        return $this
            ->belongsTo(Discount::class);
    }

    public function menuItem()
    {
        return $this
            ->belongsTo(MenuItem::class);
    }
}
