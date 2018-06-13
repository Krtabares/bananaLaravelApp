<?php

namespace App\BananaUtils;

use App\constant;
use App\BananaClient;
use App\BananaUtils\ExceptionAnalizer;

class SessionToken{


    static function generateToken($user_email,$user_id ){

        $decriptToken = $user_email.'BA'.$user_id.'NA'.date('Y-m-d-h:m:s').'NA';
        return bcrypt($decriptToken);
         
    }

}
