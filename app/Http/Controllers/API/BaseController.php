<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($result, $message)
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        return response()->json($response, 404);
    }
}
