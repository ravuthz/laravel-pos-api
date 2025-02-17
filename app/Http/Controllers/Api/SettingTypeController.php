<?php

namespace App\Http\Controllers\Api;

use App\Models\SettingType;
use App\Http\Requests\SettingTypeRequest;
use App\Http\Resources\SettingTypeResource;
// use App\Http\Resources\SettingTypeCollection;
use Ravuthz\LaravelCrud\CrudController;

class SettingTypeController extends CrudController
{
    protected $model = SettingType::class;
    protected $resource = SettingTypeResource::class;
    // protected $collection = SettingTypeCollection::class;
    protected $storeRequest = SettingTypeRequest::class;
    protected $updateRequest = SettingTypeRequest::class;


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
