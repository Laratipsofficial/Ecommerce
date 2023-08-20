<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmsContent extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'seoTitle',
        'seoDescription',
        'displayName',
        'slug',
        'content',
        'culture',
    ];
}
