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

        $result = $connection->select('SELECT * , NOW() server_date FROM oauth_access_tokens  
            WHERE user_id = :id  AND name = :app AND revoked = 0', [
            'id' => $user_id,
            'app' => $app
        ]);

        if ( empty($result) ||  $result[0]->token != $token || $result[0]->server_date > $result[0]->expires_at  ) {

            if(!empty($result)){
                $connection->select('UPDATE oauth_access_tokens  SET revoked = 1 WHERE user_id = :id ',['id' => $user_id]);
            }

            throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::UNAUTHORIZED);

        }
        

    }

}
