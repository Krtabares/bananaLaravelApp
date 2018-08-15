<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class AccessBnImplement
{

	public function selectTableAccessUser($conection, $user_id)
    {
        return $conection->raw('CALL RD_SelectTableAccessUser(:user_id)',
            ['user_id' => $user_id]
        );
    }

    public function SelectColumnAccessUser($conection, $user_id,$table_id)
    {

        $result = $conection->raw('CALL RD_SelectColumnAccessUser(:user_id,:table_id)',
            [
                'user_id' => $user_id,
                'table_id'=> $table_id
            ]
        );

        foreach ($result as $key => $column) {
            if( $column->REFERENCED_TABLE_NAME != null){
                $options = $conection->raw("SELECT id 'key', description value FROM ".$column->REFERENCED_TABLE_NAME);
                $column->REFERENCED_TABLE_NAME = $options;
            }
        }

        return $result;
    }

    public function selectTotalAccess($conection, $user_id)
    {
    	$permits = $conection->raw('CALL RD_SelectTotalAccess(:user_id)', 
    		['user_id' => $user_id]
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

}