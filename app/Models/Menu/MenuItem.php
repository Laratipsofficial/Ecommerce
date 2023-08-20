<?php

namespace App\Models\Menu;

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


    public function menuSection()
    {
        return $this
            ->belongsTo(MenuSection::class);
    }
}
