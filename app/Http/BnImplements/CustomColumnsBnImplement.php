<?php

namespace App\Http\BnImplements;

use App\Constant;
use App\User;
use Illuminate\Support\Facades\DB;


class CustomColumnsBnImplement
{


    function __construct()
    {

    }


    public function insertCustomColumns($conection,$idTable, $idtype, $name)
    {

        $check = $conection->select('SELECT id FROM custom_column WHERE name = :name ',['name'=>$name]);

        if(!empty($check)){
            throw new \Exception(Constant::MSG_DUPLICATE, Constant::DUPLICATE );
        }

        $conection->select('CALL CR_InsertCustomColumn(:id_table, :type, :name)', [
            'id_table' => $idTable,
            'type' => $idtype,
            'name' => $name
        ]);
    }



    public function insertCustomColumnsValue($conection, $value, $custom_column_id, $context_id)
    {


       $type = $conection->select("SELECT type_id from custom_column WHERE id = :custom_column_id",['custom_column_id'=>$custom_column_id]);

       if(empty($type)){
            throw new \Exception(Constant::MSG_NOT_FOUND, Constant::NOT_FOUND);
        }

       $number_value = null;
       $string_value = null;
       $date_value = null;
    
       switch (intval($type)) {

           case 1:
               $string_value = $value;
               break;
           case 2:
               $number_value = $value;
               break;
           case 3:
               $date_value = $value;
               break;
           default:
               throw new \Exception("Error en tipo de dato de columna", Constant::INTERNAL_SERVER_ERROR );
               break;
       }

        $conection->select('CALL CR_InsertCustomColumnValue(:number_value, :string_value, :date_value, :custom_column_id, :context_id)', [
            'number_value' => $number_value,
            'string_value' => $string_value,
            'date_value' => $date_value,
            'custom_column_id' => $custom_column_id,
            'context_id' => $context_id
        ]);
    }
}

