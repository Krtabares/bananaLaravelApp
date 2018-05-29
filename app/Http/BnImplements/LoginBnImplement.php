<?php

namespace App\Http\BnImplements;

use App\Constant;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\BnImplements\UserBnImplement;

class LoginBnImplement
{

    private $user_implement;

    function __construct(UserBnImplement $user_implement)
    {
        $this->user_implement = $user_implement;
    }

    public function login($conection, $email, $pass)
    {
        $user = $this->user_implement->getUserByEmail($conection,$email);

        if ($user[0]->password == $pass) {
            $result = $this->user_implement->selectPermitsUser($conection,$user[0]->id);
        }else{
            throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::UNAUTHORIZED);
        }

        return $result;

    }
}

