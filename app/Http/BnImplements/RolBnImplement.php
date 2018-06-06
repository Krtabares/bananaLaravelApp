<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class RolBnImplement
{
    public function selectRols($conection)
    {
        return $conection->select('SELECT * FROM rols ORDER BY rol_name, id;');
    }

    public function selectRolById($conection, $id)
    {
        return $conection->select('SELECT * FROM rols where id = :id_rol', ['id_rol'=>$id]);
    }

    public function insertRol($conection, $rol_name, $description, $all_access_column)
    {
        $array_object = $conection->select('CALL CR_InsertRol(:rol_name, :description, :all_access_column)', [
            'rol_name' => $rol_name,
            'description' => $description,
            'all_access_column' => $all_access_column
        ]);

        return $array_object[0]->id;
    }

    public function updateRol($conection, $rol_id, $rol_name, $description, $all_access_column)
    {
        $conection->select('CALL UP_UpdateRol(:rol_id, :rol_name, :description, :all_access_column)', [
            'rol_id' => $rol_id,
            'rol_name' => $rol_name,
            'description' => $description,
            'all_access_column' => $all_access_column
        ]);
    }

    public function archivedRol($conection, $rol_id, $archived)
    {
        $conection->select('CALL DL_ArchivedRol(:rol_id, :archived)', [
            'rol_id' => $rol_id,
            'archived' => $archived
        ]);
    }

    public function selectPermitsRol($conection, $rol_id)
    {
        $array_object = $conection->select('SELECT all_access_column from rols where rols.id = :rol_id', [
            'rol_id' => $rol_id
        ]);

        if ($array_object[0]->all_access_column)
            return ['all_access_column' => 1];

        return $conection->select('SELECT permissions_rols.*, columns.column_name
            FROM permissions_rols, columns
            WHERE ( rol_id = :rol_id ) AND ( columns.id = permissions_rols.column_id );',
            ['rol_id' => $rol_id]
        );
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
    }

    public function updatePermitsRol($conection, $rol_id, $column_id, $create, $read, $update, $delete)
    {
        $conection->select('CALL UP_UpdatepermitsRol(:rol_id, :column_id, :create, :read, :update, :delete)', [
            'rol_id' => $rol_id,
            'column_id' => $column_id,
            'create' => $create,
            'read' => $read,
            'update' => $update,
            'delete' => $delete
        ]);
    }

    public function selectFilterRols($conection, $search)
    {
        return $conection->select('CALL RD_SelectFilteredRols(:search)', ['search' => $search]);
    }

}
