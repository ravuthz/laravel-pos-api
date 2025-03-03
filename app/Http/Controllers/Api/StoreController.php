<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseCrudController;
use App\Http\Resources\StoreCollection;
use App\Models\Store;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreResource;

class StoreController extends BaseCrudController
{
    protected $model = Store::class;
    protected $resource = StoreResource::class;
    protected $collection = StoreCollection::class;
    protected $storeRequest = StoreRequest::class;
    protected $updateRequest = StoreRequest::class;

    protected $uploadFilePath = [
        'thumbnail' => 'public/stores'
    ];
}
