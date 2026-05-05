<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttachment extends Model
{
    public $timestamps = false;
    protected $primaryKey = false;

    protected $fillable = [''];

//$table->unsignedBigInteger('product_id');
//$table->unsignedBigInteger('type');
//$table->unsignedBigInteger('mime');
//$table->string('path');
//$table->smallInteger('order')->default(0);

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
