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

        $table['table_id'] = '';

        foreach ($permits as $key => $permit) {

            if (  $table['table_id'] != $permit->table_id ) {
                
                $table['table_id'] = $permit->table_id;
                $table['table_name'] = $permit->table_name;
                $tables_name[] = $table;

            }
        }

        $tables = $tables_name;

        foreach ($tables_name as $key_1 => $table) {
            
            foreach ($permits as $key_2 => $permit) {
                
                if ( $permit->table_id == $table['table_id'] ) {
                    
                    $columns['column_id'] = $permit->column_id;
                    $columns['column_name'] = $permit->column_name;
                    $columns['create'] = $permit->create;
                    $columns['read'] = $permit->read;
                    $columns['update'] = $permit->update;
                    $columns['delete'] = $permit->delete;

                    $tables[$key_1]['columns'][] = $columns;
                }
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
