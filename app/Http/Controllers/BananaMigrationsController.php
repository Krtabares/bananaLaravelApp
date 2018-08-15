<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\BananaMigrationsBnImplement;

class BananaMigrationsController extends Controller
{

    private $migration_implement;

    function __construct(BananaMigrationsBnImplement $migration_implement)
    {
        $this->migration_implement = $migration_implement;
    }

    public function selectColumnsClients(Request $request)
    {
        $db_manager = new DBManager();

        try {

             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));


                $columns = $this->migration_implement->selectColumnsClients($conection);

                // $this->migration_implement->preprareQueryMigration($conection);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['columns' => $columns]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function generateMigration(Request $request)
    {
        // ini_set('memory_limit', '-1');
        $db_manager = new DBManager();


        try {

             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));

                $conection->beginTransaction();

                if ( !$request->filled('guideMigration') )
				    throw new \Exception("Guide Migration is required", Constant::BAD_REQUEST);

                $this->migration_implement->migrate($conection, $request->guideMigration, $request->jsonImport);

                //  dd($request->jsonImport);
                $conection->commit();
        } catch (\Exception $e) {

            //  return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
            // ini_set('memory_limit', '126M');
        }

        return response(json_encode('complete'), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function validateDataThird(Request $request)
    {

        $db_manager = new DBManager();
        $conection = null;

        try {

             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));


               $result =  $this->migration_implement->validateDataThird( $conection );

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

        } finally {

            $db_manager->terminateClientBDConecction();

        }

        return response(json_encode(['result' => $result]), Constant::OK)->header('Content-Type', 'application/json');
    }




}
