<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class UserBnImplement
{
    public function selectUsers($conection)
    {
        return $conection->select('CALL RD_SelectUsers()');
    }

    public function selectFilterUsers($conection, $search)
    {
        return $conection->select('CALL RD_SelectFilteredUsers(:search)', ['search' => $search]);
    }

	public function selectPermitsUser($conection, $user_id)
    {
        return $conection->select('CALL RD_SelectPermitsUser(:user_id)',
            ['user_id' => $user_id]
        );
    }

    public function insertUser($conection, $rol_id, $user_name, $password, $email,
        $all_access_organization, $all_access_column)
    {
        $token = 'GENERAR TOKEN';

        $array_object = $conection->select('CALL CR_InsertRol(:rol_id, :user_name, :password,
            :email, :all_access_organization, :all_access_column, :token)', [
                'rol_id' => $rol_id,
                'user_name' => $user_name,
                'password' => bcrypt( $password ),
                'email' => $email,
                'all_access_organization' => $all_access_organization,
                'all_access_column' => $all_access_column,
                'token' => $token
            ]);

        return $array_object[0]->id;
    }

    /*INSERT PERMITS*/

    public function getUserByEmail($conection,$email)
    {
        return $conection->select('CALL RD_LoginUser(:email_user)',['email_user' => $email]);
    }

}