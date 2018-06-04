<?php

namespace App\Http\BnImplements;

use App\Constant;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\BnImplements\UserBnImplement;
use App\Http\BnImplements\AccessBnImplement;

class LoginBnImplement
{

    private $user_implement;
    private $access_implement;

    function __construct(UserBnImplement $user_implement, AccessBnImplement $access_implement)
    {
        $this->user_implement = $user_implement;
        $this->access_implement = $access_implement;
    }

    public function login($conection, $email, $pass)
    {
        $user = $this->user_implement->getUserByEmail($conection,$email);

        if ($user[0]->password == $pass) {
            $result = $this->access_implement->selectTableAccessUser($conection,$user[0]->id);
        }else{
            throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::UNAUTHORIZED);
        }

        return $result;

    }
}

