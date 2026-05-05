<?php

namespace App\Models;

use App\Traits\HasAudit;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, HasSlug, SoftDeletes, HasAudit;

    protected $guarded = ['id'];

//    public function categories()
//    {
//        return $this->hasManyThrough(
//            Category::class,
//            ProductCategory::class,
//            'product_id',
//            'id',
//            'category_id',
//        );
//    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function attachments()
    {
//        return $this->belongsToMany(ProductAttachment::class, 'product_attachments', 'product_id', 'attachment_id');
        return $this->hasMany(ProductAttachment::class, 'product_id', 'id');
    }

    public function images()
    {
        return $this->attachments()->where('type', '=', 1);
//        return $this->belongsToMany(ProductAttachment::class)
//            ->where('type', 'image');
    }

    public function videos()
    {
        return $this->belongsToMany(ProductAttachment::class)
            ->where('type', 'video');
    }

    public function varients()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
