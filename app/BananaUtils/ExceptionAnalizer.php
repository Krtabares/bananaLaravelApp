<?php

namespace App\BananaUtils;

use App\Constant;
use App\BananaClient;

class ExceptionAnalizer{

    private  $exception;

    function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    public static function analizerHTTPResponse($exception)
    {
        if ($exception instanceof \Illuminate\Database\QueryException)  {

            $MSG = Constant::MSG_ERROR_DB;
            $status = Constant::NOT_IMPLEMENTED;
            // dd($exception->getCode());

            $code = ($exception->errorInfo != null)? $exception->errorInfo[1] : $exception->getCode();

            switch ($code) {

                case Constant::DUPLICATE :
                    $MSG = Constant::MSG_DUPLICATE;
                break;

                case Constant::TOO_LONG :
                    $MSG = Constant::MSG_TOO_LONG;
                break;

                case Constant::NOT_NULL :
                    $MSG = Constant::MSG_NOT_NULL;
                break;

                case Constant::TB_NOT_FOUND :
                    $MSG = Constant::MSG_TB_NOT_FOUND;
                break;

                case Constant::ACCESS_DENIED :
                    $MSG = Constant::MSG_ACCESS_DENIED;
                break;

                case Constant::UNKNOWN_DATABASE :
                    $MSG = Constant::MSG_UNKNOWN_DATABASE;
                break;

                default:
                    $MSG = Constant::MSG_ERROR_DB;
                break;
            }

            return response( $MSG , $status)->header('Content-Type', 'application/json'); 
        }else{

            $status = Constant::INTERNAL_SERVER_ERROR;

            if ($exception->getCode() == Constant::BAD_REQUEST) {
                 $status = Constant::BAD_REQUEST;
            }

            return response($exception->getMessage(),$status)->header('Content-Type', 'application/json');

        }



    }
  

}
