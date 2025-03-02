<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class BaseCrudController extends Controller
{
    protected $model = null;
    protected $resource = null;
    protected $collection = null;
    protected $storeRequest = null;
    protected $updateRequest = null;
    protected $uploadFilePath = [];

    public function getModel($id = null): Model
    {
        return $id ? app($this->model)->findOrFail($id) : app($this->model);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function parseRequest(Request $request): array
    {
        $input = $request->all();
        $filePath = 'public/files';

        foreach ($request->files as $name => $file) {
            if (isset($this->uploadFilePath[$name])) {
                $filePath = $this->uploadFilePath[$name];
            }
            $input[$name] = $file->storeAs($filePath, $file->getClientOriginalName());
        }

        return $input;
    }

    public function parseResponse(mixed $data, $status = null, $message = null)
    {
        $json = [];

        if ($data instanceof Model) {
            $json = $this->resource ? $this->resource::make($data) : JsonResource::make($data);
        }

        if ($data instanceof Paginator || $data instanceof Collection) {
            if ($this->collection) {
                $data = $this->collection::make($data);
            } else if ($this->resource) {
                $data = $this->resource::collection($data);
            }
        }

        if ($data instanceof ResourceCollection) {
            $meta = $data->response()->getData(true)['meta'];
            $json['meta'] = [
                'size' => $meta['per_page'],
                'page' => $meta['current_page'],
                'total_pages' => $meta['last_page'],
                'total_items' => $meta['total'],
            ];
            $json['data'] = $data;
        }

        return $this->responseJson($json, $status, $message);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->getModel()->paginate($request->query('size', 10));
        return $this->parseResponse($data, 200, 'Fetched All');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->getModel($id);
        return $this->parseResponse($data, 200, 'Fetched One');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = $this->getModel();
        $body = $this->storeRequest ? app($this->storeRequest) : $request;
        $input = $this->parseRequest($body);
        $model->fill($input)->save();
        return $this->parseResponse($model, 200, 'Created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = $this->getModel($id);
        $body = $this->updateRequest ? app($this->updateRequest) : $request;
        $input = $this->parseRequest($body);
        $model->fill($input)->save();
        return $this->parseResponse($model, 200, 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->getModel($id)->delete($id);
        return $this->parseResponse($result, 200, 'Deleted');
    }
}
