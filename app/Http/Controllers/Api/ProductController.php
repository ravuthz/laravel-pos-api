<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseCrudController;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ProductController extends BaseCrudController
{
    protected $model = Product::class;
    protected $resource = ProductResource::class;
    protected $collection = ProductCollection::class;
    protected $storeRequest = ProductRequest::class;
    protected $updateRequest = ProductRequest::class;

    protected $uploadFilePath = [
        'thumbnail' => 'public/products'
    ];
}
