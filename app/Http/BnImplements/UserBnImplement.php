<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class UserBnImplement
{
	public function selectPermitsUser($conection, $user_id)
    {
        return $conection->select('CALL RD_SelectPermitsUser(:user_id)',
            ['user_id' => $user_id]
        );
    }
}