<?php

namespace App\Helpers;

class Helper
{
    private static $result = '';
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public static function successResponse($result = [], $message, $paginate = false, $code=200)
    {
        self::$result = $result;

        if ($paginate == true) {
            self::paginate($result);
        }

        $response = [
            'success' => true,
            'status_code'    =>$code,
            'message' => [$message],
           // 'message' =>$message,
            'data'   => self::$result
        ];
        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */

    public static function errorResponse($error, $code = 500, $errorMessages = [])
    {
        $statusCode = $code == 0 ? 500 : $code;
        $response = [
            'success' => false,
            'status_code' =>$statusCode,
            'message' => $error,
            'data'    => $errorMessages
        ];

        return response()->json($response, $statusCode);
    }

    public static function paginate($data = [])
    {
        $paginationArray = null;
        if ($data != null) {
            $paginationArray = array('list'=>$data->items(),'pagination'=>[]);
            $paginationArray['pagination']['total'] = $data->total();
            $paginationArray['pagination']['current'] = $data->currentPage();
            $paginationArray['pagination']['first'] = 1;
            $paginationArray['pagination']['last'] = $data->lastPage();
            if ($data->hasMorePages()) {
                if ($data->currentPage() == 1) {
                    $paginationArray['pagination']['previous'] = 0;
                } else {
                    $paginationArray['pagination']['previous'] = $data->currentPage()-1;
                }
                $paginationArray['pagination']['next'] = $data->currentPage()+1;
            } else {
                $paginationArray['pagination']['previous'] = $data->currentPage()-1;
                $paginationArray['pagination']['next'] =  $data->lastPage();
            }
            if ($data->lastPage() > 1) {
                $paginationArray['pagination']['pages'] = range(1, $data->lastPage());
            } else {
                $paginationArray['pagination']['pages'] = [1];
            }
            $paginationArray['pagination']['from'] = $data->firstItem();
            $paginationArray['pagination']['to'] = $data->lastItem();
            //$paginationArray;
            //
            return self::$result = $paginationArray;

            /// }else {
            //     $paginationArray = $data;
            //     return self::$result = $paginationArray;
            // }
        }
        //return $paginationArray;
    }

}
