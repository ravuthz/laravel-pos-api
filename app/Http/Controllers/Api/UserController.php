<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseCrudController;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;

// use App\Http\Resources\UserCollection;

class UserController extends BaseCrudController
{
    protected $model = User::class;
    protected $resource = UserResource::class;
    protected $collection = UserCollection::class;
    protected $storeRequest = UserRequest::class;
    protected $updateRequest = UserRequest::class;

    // Set upload file path, default is 'public/files'
    protected $uploadFilePath = [
        'avatar' => 'public/avatars'
    ];

}
