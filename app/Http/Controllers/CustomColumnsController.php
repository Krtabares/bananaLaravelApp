<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\CustomColumnsBnImplement;

class CustomColumnsController extends Controller
{
    private $CustomColums_implement;

    function __construct(CustomColumnsBnImplement $CustomColums_implement)
    {
        $this->CustomColums_implement = $CustomColums_implement;
    }

	public function createCustomColumns(Request $request)
	{

 		$db_manager = new DBManager();

        try {
         
            if ( !$request->filled('authorization') )
                throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

            $conection = $db_manager->getClientBDConecction(
                $request->authorization,
                $request->user_id,
                $request->token,
                $request->app
            );

            if ( !$request->filled('type') ) {
            	throw new \Exception("Type is required", Constant::BAD_REQUEST);
            }
            if ( !$request->filled('name') ) {
            	throw new \Exception("Name is required", Constant::BAD_REQUEST);
            }

            $filter_countries = $this->CustomColums_implement->insertCustomColumns($conection, $request->type, $request->name );
                
            

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['filter_countries' => $filter_countries]), Constant::OK)->header('Content-Type', 'application/json');
    }
}

