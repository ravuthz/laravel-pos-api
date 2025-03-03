<?php

namespace App\Traits;

use Illuminate\Testing\TestResponseAssert as PHPUnit;

trait HasCrudTest
{
    public int $idOk = 1;
    public int $idFail = 9999;

    abstract function requestPayload($id = null): array;

    public function requestRoute($id = null): string
    {
        abort_if(!isset($this->route), 500, 'Route not defined');
        return $this->route . '/' . ($id ?? '');
    }

    public function assertStatusWithClass($response, $statusCode)
    {
        $className = get_class($this);
        $message = "Error in $className: Expected status $statusCode, but received {$response->status()}.";
        $this->assertSame($statusCode, $response->getStatusCode(), $message);
        return $this;

    }

    public function test_index(): void
    {
        $res = $this->getJson($this->requestRoute());
        $this->assertStatusWithClass($res, 200);
    }

    public function test_store(): void
    {
        $res = $this->postJson($this->requestRoute(), $this->requestPayload());
        $this->assertStatusWithClass($res, 200);
    }

    public function test_show(): void
    {
        $res = $this->getJson($this->requestRoute($this->idOk));
        $this->assertStatusWithClass($res, 200);
    }

    public function test_show_not_found(): void
    {
        $res = $this->getJson($this->requestRoute($this->idFail));
        $this->assertStatusWithClass($res, 404);
    }

    public function test_update(): void
    {
        $res = $this->patchJson($this->requestRoute($this->idOk), $this->requestPayload($this->idOk));
        $this->assertStatusWithClass($res, 200);
    }

    public function test_update_not_found(): void
    {
        $res = $this->patchJson($this->requestRoute($this->idFail), $this->requestPayload($this->idFail));
        $this->assertStatusWithClass($res, 404);
    }

    public function test_destroy(): void
    {
        $res = $this->deleteJson($this->requestRoute($this->idOk));
        $this->assertStatusWithClass($res, 200);
    }

    public function test_destroy_not_found(): void
    {
        $res = $this->deleteJson($this->requestRoute($this->idFail));
        $this->assertStatusWithClass($res, 404);
    }
}
