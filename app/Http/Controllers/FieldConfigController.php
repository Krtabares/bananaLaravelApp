<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\FieldConfigBnImplement;
use App\Http\BnImplements\CustomColumnsBnImplement;

class FieldConfigController extends Controller
{
    private $fieldConf_implement;

    function __construct(FieldConfigBnImplement $fieldConf_implement)
    {
        $this->fieldConf_implement = $fieldConf_implement;

    }

    public function getfieldList(Request $request,$id)
    {
    

 		$db_manager = new DBManager();

        try {
         
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));

             if ( !isset($id) ) {
            	throw new \Exception("table is required", Constant::BAD_REQUEST);
            }


         $columns = $this->fieldConf_implement->getfieldList($conection,$id);
         
         $elements = $this->fieldConf_implement->getElementsView($conection);

                
        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

                return response(json_encode([
        	'elements'=> $elements,
        	'columns' => $columns
    	]), Constant::OK)->header('Content-Type', 'application/json');

    }

    public function UpdateConfiguration(Request $request)
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

            if ( !$request->filled('id_type') ) {
            	throw new \Exception("Type is required", Constant::BAD_REQUEST);
            }
            if ( !$request->filled('position') ) {
            	throw new \Exception("Name is required", Constant::BAD_REQUEST);
            }
            if ( !$request->filled('idtable') ) {
            	throw new \Exception("Table is required", Constant::BAD_REQUEST);
            }

            $isValid = -1;

            if ( $request->filled('columnId') ) {
            	 $isValid = 1;            	
            }

            if( $request->filled('customColumnId')){
				$isValid = 2;
            }

            if ($isValid == -1) {
            	throw new \Exception("column is required", Constant::BAD_REQUEST);
            }

            switch ($isValid) {
            	case 1:
            		$this->fieldConf_implement->UpdateConfiguration(
            			$conection,
            			$request->id_type,
            			$request->position,
            			$request->required,
            			$request->columnId,
            			null);
            		break;
            	case 2:
            	// dd($request->customColumnId);
	            	$this->fieldConf_implement->UpdateConfiguration(
	            			$conection,
	            			$request->id_type,
	            			$request->position,
	            			$request->required,
	            			null,
	            			$request->customColumnId);
            		
            		break;
            	
            }


         	$columns = $this->fieldConf_implement->getfieldList($conection, $request->idtable);

                
            

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['columns' => $columns]), Constant::OK)->header('Content-Type', 'application/json');
    }

}
