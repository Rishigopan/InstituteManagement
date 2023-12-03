<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
     /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function sendResponse($var, $result,$code, $message)
     {
         $response = [
             'success' => true,
             $var => $result,
             'code' =>$code,
             'message' => $message,
         ];
 
         return response()->json($response, 200);
     }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['error'] = $errorMessages;
        }
        return response()->json($response, 200);
        //      return response()->json($response, $code);
    }
}
