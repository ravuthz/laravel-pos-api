<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseCrudController;
use App\Models\Setting;
use App\Http\Requests\SettingRequest;
use App\Http\Resources\SettingResource;
use App\Http\Resources\SettingCollection;

class SettingController extends BaseCrudController
{
    protected $model = Setting::class;
    protected $resource = SettingResource::class;
    protected $collection = SettingCollection::class;
    protected $storeRequest = SettingRequest::class;
    protected $updateRequest = SettingRequest::class;
}
