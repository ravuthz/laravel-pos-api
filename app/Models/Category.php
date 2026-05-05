<?php

namespace App\Models;

use App\Traits\HasAudit;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, HasSlug, SoftDeletes, HasAudit;

    protected $guarded = ['id'];

//    public function products()
//    {
//        return $this->hasManyThrough(
//            Product::class,
//            ProductCategory::class,
//            'product_id',
//            'category_id',
//            'id',
//        );
//    }
}
