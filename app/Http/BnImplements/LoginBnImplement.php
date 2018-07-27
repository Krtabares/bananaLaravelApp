<?php

namespace App\Http\BnImplements;

use App\Constant;
use App\User;
use Illuminate\Support\Facades\DB;
use App\BananaUtils\SessionToken;
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

    public function login($conection, $email, $pass, $app)
    {


        $user = $this->user_implement->getUserByEmail($conection,$email);
        //  dd($user[0]->password);
        if (trim($user[0]->password) != $pass) {

            throw new \Exception(Constant::MSG_INVALID_PASS, Constant::UNAUTHORIZED);

        }else{

            $token = SessionToken::generateToken($user[0]->email,$user[0]->id);

            $this->insertToken($conection, $user[0]->id, $app, $token,FALSE);

            $user[0]->remember_token = $token;

            $result = $this->access_implement->selectTableAccessUser($conection,$user[0]->id);
        }

        return ['user'=>$user,'access'=>$result];

    }

    public function insertToken($conection, $user_id, $name, $token, $revoked)
    {
        $conection->select('CALL CR_InsertToken(:user_id, :name, :token, :revoked)', [
            'user_id' => $user_id,
            'name' => $name,
            'token' => $token,
            'revoked' => $revoked
        ]);
    }
}

