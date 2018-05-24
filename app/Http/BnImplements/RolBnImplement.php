<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class RolBnImplement
{
    public function selectRol($conection)
    {
        return $conection->select('CALL RD_Rols()');
    }

    public function insertRol($conection, $rol_name, $description, $all_access_column)
    {
        try {

            $conection->select('CALL CR_Rols(:rol_name, :description, :all_access_column)', [
                'rol_name' => $rol_name,
                'description' => $description,
                'all_access_column' => $all_access_column
            ]);

        } catch (Exception $e) {
            
        }

        return Constant::MSG_SUCCESS;
    }

}
