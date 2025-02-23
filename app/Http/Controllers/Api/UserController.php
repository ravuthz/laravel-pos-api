<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;

// use App\Http\Resources\UserCollection;
use Ravuthz\LaravelCrud\CrudController;

class UserController extends CrudController
{
    protected $model = User::class;
    protected $resource = UserResource::class;
    protected $collection = UserCollection::class;
    protected $storeRequest = UserRequest::class;
    protected $updateRequest = UserRequest::class;


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
