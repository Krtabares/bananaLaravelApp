<?php

namespace App\BananaUtils;

use App\constant;
use App\BananaClient;

class SessionToken{


    static function generateToken($user_email,$user_id ){

        $decriptToken = $user_email.'BA'.$user_id.'NA'.date('Y-m-d-h:m:s').'NA';
        return bcrypt($decriptToken);
         
    }

    static function  validateToken($connection, $user_id, $token, $app){

        if(!isset($user_id)){
                throw new \Exception("ID de Usuario es un campo requerido para autenticar", Constant::BAD_REQUEST);
        }
        if(!isset($token)){
                throw new \Exception("TOKEN de Usuario es un campo requerido para autenticar", Constant::BAD_REQUEST);
        }
        if(!isset($app)){
                throw new \Exception("App es un campo requerido para autenticar", Constant::BAD_REQUEST);
        }

        $result = $connection->select('SELECT * ,  
            if (now() > expires_at, 1, 0) expired
            FROM oauth_access_tokens  
            WHERE user_id = :id  AND name = :app AND revoked = 0', [
            'id' => $user_id,
            'app' => $app
        ]);

        if(empty($result)){
             throw new \Exception("Sin sesion activa", Constant::UNAUTHORIZED);
        }
        if($result[0]->token != $token){

            // $connection->select('UPDATE oauth_access_tokens  SET revoked = 1 WHERE user_id = :id ',['id' => $user_id]);
            
            throw new \Exception("Usted. Se ha Logeado desde otro dispositivo esta sesion fue cerrada", Constant::UNAUTHORIZED);
        }
        if( $result[0]->expired ){

            $connection->select('UPDATE oauth_access_tokens  SET revoked = 1 WHERE user_id = :id ',['id' => $user_id]);
            
            throw new \Exception("Esta sesion a expirado", Constant::UNAUTHORIZED);
        }
        

    }

}
