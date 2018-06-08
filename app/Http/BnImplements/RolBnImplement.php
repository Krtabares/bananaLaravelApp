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
        $rol = $conection->select('SELECT * FROM rols where id = :id_rol', ['id_rol'=>$id]);
        $permissions_rols = $this->selectAllPermitsRol($conection, $id);
        return ['rol'=>$rol,'permissions'=>$permissions_rols];
    }

    public function insertRol($conection, $rol_name, $description, $all_access_column)
    {
        $array_object = $conection->select('CALL CR_InsertRol(:rol_name, :description, :all_access_column)', [
            'rol_name' => $rol_name,
            'description' => $description,
            'all_access_column' => $all_access_column
        ]);

        return $array_object[0];
    }

    public function updateRol($conection, $rol_id, $rol_name, $description, $all_access_column)
    {
        $array_object = $conection->select('CALL UP_UpdateRol(:rol_id, :rol_name, :description, :all_access_column)', [
            'rol_id' => $rol_id,
            'rol_name' => $rol_name,
            'description' => $description,
            'all_access_column' => $all_access_column
        ]);

        return $array_object[0];
    }

    public function archivedRol($conection, $rol_id, $archived)
    {
        $array_object = $conection->select('CALL DL_ArchivedRol(:rol_id, :archived)', [
            'rol_id' => $rol_id,
            'archived' => $archived
        ]);

        return $array_object[0];
    }

    public function selectAllPermitsRol($conection, $rol_id)
    {
        $permits = $conection->select('CALL RD_SelectPermitsAssociatesAll(:rol_id);',
            ['rol_id' => $rol_id]
        );

        $table_id = 0;
        $index = 0;

        foreach ($permits as $key => $permit) {

            if (  $table_id != $permit->table_id ) {
                
                $tables[$index]['table_id'] = $permit->table_id;
                $tables[$index]['table_name'] = $permit->table_name;
                $tables[$index]['table_description'] = $permit->table_description;

                $columns['column_id'] = $permit->column_id;
                $columns['column_name'] = $permit->column_name;
                $columns['column_description'] = $permit->column_description;
                $columns['create'] = $permit->create;
                $columns['read'] = $permit->read;
                $columns['update'] = $permit->update;
                $columns['delete'] = $permit->delete;
                $columns['selected'] = $permit->selected;

                $tables[$index]['columns'][] = $columns;

                $table_id = $permit->table_id;
                $index++;

            } elseif ( $table_id == $permit->table_id ) {

                $columns['column_id'] = $permit->column_id;
                $columns['column_name'] = $permit->column_name;
                $columns['column_description'] = $permit->column_description;
                $columns['create'] = $permit->create;
                $columns['read'] = $permit->read;
                $columns['update'] = $permit->update;
                $columns['delete'] = $permit->delete;
                $columns['selected'] = $permit->selected;

                $tables[$index - 1]['columns'][] = $columns;

            }
        }

        return $tables;
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
