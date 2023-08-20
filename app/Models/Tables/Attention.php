<?php

namespace App\Models\Tables;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attention extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'table_id',
    ];
}
