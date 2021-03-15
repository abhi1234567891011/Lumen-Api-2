<?php

//Basically this ia used to normalize the response that is all the response will be standarized into JSON format.
namespace App\Traits;

use Illuminate\Http\Response;


trait ApiResponser{

    /**
     * Build a sucess response
     * @param string|array $data
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     */
      //Response::HTTP_OK == will return ok code of 200
     public function sucessResponse($data , $code = Response::HTTP_OK){
        
        return response()->json(['data' => $data],$code);
     }

     
     /**
     * Build a sucess response
     * @param string|array $data
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     */
        public function errorResponse($message , $code){
        
            return response()->json(['error' => $message,'code' => $code] , $code);
         }
}



