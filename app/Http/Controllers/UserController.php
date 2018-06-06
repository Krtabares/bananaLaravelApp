<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\UserBnImplement;

class UserController extends Controller
{

	private $user_implement;


	function __construct(UserBnImplement $user_implement)
	{
		$this->user_implement = $user_implement;
	}

    public function indexUser(Request $request)
    {
        $db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            $users = $this->user_implement->selectUsers($conection);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['users' => $users]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function indexFilterUser(Request $request)
    {
        $db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('filter') ) {

                $filter_users = $this->user_implement->selectFilterUsers($conection, $request->filter);

            } else 
                throw new \Exception("Filter is required", Constant::BAD_REQUEST);
            

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['filter_users' => $filter_users]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function storeUser(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('rol_id') && $request->filled('user_name') && $request->filled('email')
                && $request->filled('password') && $request->filled('all_access_organization') ) {

                $user_insert = $this->user_implement
                    ->insertUser($conection, $request->rol_id, $request->user_name, $request->password,
                        $request->email, $request->all_access_organization);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['user_insert' => $user_insert], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function updateUser(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('user_id') && $request->filled('rol_id') && $request->filled('user_name')
                && $request->filled('email') && $request->filled('password')
                && $request->filled('all_access_organization') && $request->filled('all_access_column') ) {

                $user_update = $this->user_implement
                    ->updateUser($conection, $request->user_id, $request->rol_id, $request->user_name,
                        $request->password, $request->email, $request->all_access_organization,
                        $request->all_access_column);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['user_update' => $user_update], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function archivedUser(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('user_id') && $request->filled('archived') ) {

                $user_archived = $this->user_implement->archivedUser($conection, $request->user_id, $request->archived);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['user_archived' => $user_archived], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function storePermitsUser(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('user_id') && $request->filled('permits_user') ) {

                foreach ($request->permits_user as $key => $permit_user) {
                    
                    $this->user_implement
                        ->insertPermitsUser($conection, $request->user_id, $permit_user['column_id'], $permit_user['create'],
                        $permit_user['read'], $permit_user['update'], $permit_user['delete']);

                }

                $permits_user = $this->user_implement->selectAllPermitsUser($conection, $request->user_id);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['permits_user' => $permits_user], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function updatePermitsUser(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('user_id') && $request->filled('permits_user') ) {

                foreach ($request->permits_user as $key => $permit_user) {
                    
                    $this->user_implement
                        ->updatePermitsUser($conection, $request->user_id, $permit_user['column_id'], $permit_user['create'],
                        $permit_user['read'], $permit_user['update'], $permit_user['delete']);

                }

                $permits_user = $this->user_implement->selectAllPermitsUser($conection, $request->user_id);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['permits_user' => $permits_user], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function getUserByEmail(Request $request,$email)
    {        
    	// dd($email);
        $db_manager = new DBManager();

        try {   

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if(!is_null($email) && strlen(trim($email)) > 1){
            	 $user = $this->user_implement->getUserByEmail($conection,$email);
            }else 
            	 throw new \Exception(json_encode("Email es un campo requerido"), Constant::BAD_REQUEST);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode($user), Constant::OK)->header('Content-Type', 'application/json');
    }
}
