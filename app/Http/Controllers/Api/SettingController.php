<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Http\Requests\SettingRequest;
use App\Http\Resources\SettingResource;
// use App\Http\Resources\SettingCollection;
use Ravuthz\LaravelCrud\CrudController;

class SettingController extends CrudController
{
    protected $model = Setting::class;
    protected $resource = SettingResource::class;
    // protected $collection = SettingCollection::class;
    protected $storeRequest = SettingRequest::class;
    protected $updateRequest = SettingRequest::class;


    // Override this method to add custom logic before saving
    protected function beforeSave($request, $model, $id = null)
    {
        return $model;
    }

    // Override this method to add custom logic after saving
    protected function afterSave($request, $model, $id = null)
    {
        return $model;
    }

}
