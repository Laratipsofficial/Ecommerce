<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuSideItem extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];
}
