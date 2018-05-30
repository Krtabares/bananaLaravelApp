<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class AccessBnImplement
{

	public function selectTableAccessUser($conection, $user_id)
    {
        return $conection->select('CALL RD_SelectTableAccessUser(:user_id)',
            ['user_id' => $user_id]
        );
    }

    public function selectTotalAccess($conection, $user_id)
    {
    	return $conection->select('CALL RD_SelectTotalAccess(:user_id)', 
    		['user_id' => $user_id]
    	);
    }

}
