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
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));


                $columns = $this->migration_implement->selectColumnsClients($conection);


        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['columns' => $columns]), Constant::OK)->header('Content-Type', 'application/json');
    }
}
