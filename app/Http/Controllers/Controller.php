<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function responseJson($data = null, $status = 200, $message = 'Successfully')
    {
        return response()->json(
            [
                'data' => $data,
                'status' => $status,
                'message' => $message
            ],
            $status
        );
    }

    public function jsonOk($data, $status = 200,  $message = 'OK')
    {
        $result['data'] = $data;
        $result['status'] = $status;
        $result['message'] = $message;
        $result['success'] = true;
        return response()->json($result, $status);
    }

    public function jsonError($error, $status = 200, $message = '')
    {
        $result['error'] = $error;
        $result['status'] = $status;
        $result['message'] = $message;
        $result['success'] = false;
        return response()->json($result, $status);
    }
}
