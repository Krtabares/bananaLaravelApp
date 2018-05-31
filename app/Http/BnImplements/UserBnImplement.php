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
        $array_object = $conection->select('SELECT all_access_column from users where users.id = :user_id', [
            'user_id' => $user_id
        ]);

        if ($array_object[0]->all_access_column)
            return ['all_access_column' => 1];

        return $conection->select('CALL RD_SelectPermitsUser(:user_id)',
            ['user_id' => $user_id]
        );
    }

    public function insertUser($conection, $rol_id, $user_name, $password, $email,
        $all_access_organization, $all_access_column)
    {
        $token = 'GENERAR TOKEN';

        $array_object = $conection->select('CALL CR_InsertUser(:rol_id, :user_name, :password,
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

    public function updateUser($conection, $user_id, $rol_id, $user_name, $password, $email,
        $all_access_organization, $all_access_column)
    {

        $conection->select('CALL UP_UpdateUser(:user_id, :rol_id, :user_name, :password,
            :email, :all_access_organization, :all_access_column)', [
                'user_id' => $user_id,
                'rol_id' => $rol_id,
                'user_name' => $user_name,
                'password' => bcrypt( $password ),
                'email' => $email,
                'all_access_organization' => $all_access_organization,
                'all_access_column' => $all_access_column
            ]);
    }

    public function archivedUser($conection, $user_id, $archived)
    {
        $conection->select('CALL DL_ArchivedUser(:user_id, :archived)', [
            'user_id' => $user_id,
            'archived' => $archived
        ]);
    }

    public function insertPermitsUser($conection, $user_id, $column_id, $create, $read, $update, $delete)
    {
        $conection->select('CALL CR_InsertPermitsUser(:user_id, :column_id, :create, :read, :update, :delete)', [
            'user_id' => $user_id,
            'column_id' => $column_id,
            'create' => $create,
            'read' => $read,
            'update' => $update,
            'delete' => $delete
        ]);
    }

    public function updatePermitsUser($conection, $user_id, $column_id, $create, $read, $update, $delete)
    {
        $conection->select('CALL UP_UpdatePermitsUser(:user_id, :column_id, :create, :read, :update, :delete)', [
            'user_id' => $user_id,
            'column_id' => $column_id,
            'create' => $create,
            'read' => $read,
            'update' => $update,
            'delete' => $delete
        ]);
    }

    public function getUserByEmail($conection,$email)
    {
        return $conection->select('CALL RD_LoginUser(:email_user)',['email_user' => $email]);
    }

}