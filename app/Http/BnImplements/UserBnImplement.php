<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class UserBnImplement
{
    public function getUserByEmail($conection,$email)
    {
        return $conection->select('CALL RD_LoginUser(:email_user)',['email_user' => $email]);
    }


}
