<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseCrudController;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends BaseCrudController
{
    protected $model = Category::class;
    protected $resource = CategoryResource::class;
    protected $collection = CategoryCollection::class;
    protected $storeRequest = CategoryRequest::class;
    protected $updateRequest = CategoryRequest::class;

    protected $uploadFilePath = [
        'thumbnail' => 'public/categories'
    ];
}
