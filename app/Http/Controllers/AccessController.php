<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\RolBnImplement;
use App\Http\BnImplements\UserBnImplement;
use App\User;
use App\Rol;

class AccessController extends Controller
{
    private $rol_implement;
    private $user_implement;

    public function __construct(RolBnImplement $rol_implement, UserBnImplement $user_implement){
        $this->rol_implement = $rol_implement;
        $this->user_implement = $user_implement;
    }

    public function rolPermitsAccess(Request $request)
    {
    	$db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            $permits_rol = $this->rol_implement->selectPermitsRol($conection, $request->rol_id);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['permits_rol' => $permits_rol]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function userPermitsAccess(Request $request)
    {

        $db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            $permits_user = $this->user_implement->selectPermitsUser($conection, $request->user_id);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['permits_user' => $permits_user]), Constant::OK)->header('Content-Type', 'application/json');
    }

   //  public function comparePermits(Request $request)
   //  {
   //      $user = User::findOrFail($request->id);

   //      $permits = DB::select('SELECT pr.column_id, pr.create, pr.read, pr.update, pr.delete
			// FROM permissions_rols pr, permissions_users pu
		 //    WHERE pr.rol_id = :rol_id
			//     AND pr.column_id NOT IN (
			//         SELECT column_id from permissions_users WHERE user_id = :user_id
			//     )
			// UNION
		 //    	SELECT pu.column_id, pu.create, pu.read, pu.update, pu.delete
		 //        FROM permissions_users pu
		 //        WHERE pu.user_id = :user_id
		 //        ORDER BY column_id;', ['rol_id' => $user->rol_id, 'user_id' => $user->id]);

   //      return ['permits' => $permits];
   //  }
}
