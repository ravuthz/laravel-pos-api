<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseCrudController;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Models\ProductAttachment;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $data = $this->getModel()
            ->with(['categories', 'images'])
            ->paginate($request->query('size', 10));
        return $this->parseResponse($data, 200, 'Fetched All');
    }

    public function saveFromRequest($model, $request)
    {
        $categories = $request->get('categories', []);
        $images = $request->get('images', []);
        $videos = $request->get('videos', []);

        $input = $this->parseRequest($request);

        $model->fill($input)->save();

        if (!empty($categories)) {
            $model->categories()->sync($categories);
        }

        if (!empty($images)) {
            foreach ($images as $image) {
                $model->attachments()->create([
                    'type' => 'image',
                    ...$image
                ]);
            }
        }

        if (!empty($videos)) {
            foreach ($videos as $video) {
                $model->attachments()->create([
                    'type' => 'video',
                    ...$video
                ]);
            }
        }

        return $model;
    }

}
