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

            if ( !$request->filled('id_type') ) {
            	throw new \Exception("Type is required", Constant::BAD_REQUEST);
            }
            if ( !$request->filled('name') ) {
            	throw new \Exception("Name is required", Constant::BAD_REQUEST);
            }
            if ( !$request->filled('table_id') ) {
            	throw new \Exception("Table is required", Constant::BAD_REQUEST);
            }

            $customColumn = $this->CustomColums_implement->insertCustomColumns($conection,$request->table_id, $request->id_type, $request->name );


            $columns = $this->CustomColums_implement->getCustomColumnsByTable($conection,$request->table_id);
   
            

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

         return response(json_encode(['columns' => $columns]), Constant::OK)->header('Content-Type', 'application/json');
    }
    public function deleteCustomColumns(Request $request)
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

            if ( !$request->filled('id') ) {
            	throw new \Exception("column is required", Constant::BAD_REQUEST);
            }

            $customColumn = $this->CustomColums_implement->deleteCustomColumns($conection,$request->id);

            if ( $request->filled('table_id') ) {
            	$columns = $this->CustomColums_implement->getCustomColumnsByTable($conection,$request->table_id);
            }else{
            	$Columns = [];
            }


        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['columns' => $columns]), Constant::OK)->header('Content-Type', 'application/json');
    }

   	public function updateCustomColumns(Request $request)
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
            if ( !$request->filled('name') ) {
            	throw new \Exception("Name is required", Constant::BAD_REQUEST);
            }
            if ( !$request->filled('table_id') ) {
            	throw new \Exception("Table is required", Constant::BAD_REQUEST);
            }
            if ( !$request->filled('id') ) {
            	throw new \Exception("column is required", Constant::BAD_REQUEST);
            }

            $customColumn = $this
            ->CustomColums_implement
            ->updateCustomColumns(
            	$conection,
            	$request->table_id,
            	$request->id_type,
            	$request->name,
            	$request->id );


         	$columns = $this->CustomColums_implement->getCustomColumnsByTable($conection,$request->table_id);

                
            

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['columns' => $columns]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function insertCustomColumnsValue(Request $request)
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

            if ( !$request->filled('custom_column_id') ) {
            	throw new \Exception("ID Custom Column is required", Constant::BAD_REQUEST);
            }

            if ( !$request->filled('context_id') ) {
            	throw new \Exception("ID Context is required", Constant::BAD_REQUEST);
            }

            if ( !$request->filled('value') ) {
            	throw new \Exception("Value is required", Constant::BAD_REQUEST);
            }

            $this->CustomColums_implement->insertCustomColumnsValue(
						            							$conection, 
						            							$request->value, 
						            							$request->custom_column_id,
						            							$request->context_id );
                
        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response('', Constant::OK)->header('Content-Type', 'application/json');
    }

    public function getCustomColumnsByTable(Request $request, $id)
	{

 		$db_manager = new DBManager();

        try {
         
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));

         $columns = $this->CustomColums_implement->getCustomColumnsByTable($conection,$id);
                
        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['columns'=> $columns]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function getCustomColumnsValuesByIdColumn(Request $request, $id, $context_id = null)
	{

 		$db_manager = new DBManager();

        try {
         
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));

         $columns = $this->CustomColums_implement->getCustomColumnsValuesByIdColumn($conection,$id,$context_id);
                
        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['columns'=> $columns]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function getElementsView(Request $request, $id = null)
	{

 		$db_manager = new DBManager();

        try {
         
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));

         $elements = $this->CustomColums_implement->getElementsView($conection);

         if($id != null){
         	$columns = $this->CustomColums_implement->getCustomColumnsByTable($conection,$id);
         }else
         	$columns = null;
         
                
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


}

