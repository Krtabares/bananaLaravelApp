<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class RolBnImplement
{
    public function selectRol($conection)
    {
        return $conection->select('CALL RD_SelectRols()');
    }

    public function insertRol($conection, $rol_name, $description, $all_access_column)
    {

        $conection->select('CALL CR_InsertRols(:rol_name, :description, :all_access_column)', [
            'rol_name' => $rol_name,
            'description' => $description,
            'all_access_column' => $all_access_column
        ]);


        return Constant::MSG_INSERT;
    }

    public function updateRol($conection, $rol_id, $rol_name, $description, $all_access_column)
    {
        $conection->select('CALL UP_UpdateRols(:rol_id, :rol_name, :description, :all_access_column)', [
            'rol_id' => $rol_id,
            'rol_name' => $rol_name,
            'description' => $description,
            'all_access_column' => $all_access_column
        ]);

        return Constant::MSG_UPDATE;
    }

    public function archivedRol($conection, $rol_id, $archived)
    {
        $conection->select('CALL DL_ArchivedRol(:rol_id, :archived)', [
            'rol_id' => $rol_id,
            'archived' => $archived
        ]);

        return Constant::MSG_ARCHIVED;
    }

    public function insertPermitsRol($conection, $rol_id, $column_id, $create, $read, $update, $delete)
    {
        $conection->select('CALL CR_InsertPermitsRol(:rol_id, :column_id, :create, :read, :update, :delete)', [
            'rol_id' => $rol_id,
            'column_id' => $column_id,
            'create' => $create,
            'read' => $read,
            'update' => $update,
            'delete' => $delete
        ]);

        return Constant::MSG_INSERT;
    }

}
