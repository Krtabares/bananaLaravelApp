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


    public function updateCustomColumns($conection,$idTable, $idtype, $name, $idColumn)
    {

        $check = $conection->select('SELECT id FROM custom_column WHERE name = :name and id <> :idColumn',
            [
                'name'=>$name,
                'idColumn'=>$idColumn
        ]);

        if(!empty($check)){ 
            throw new \Exception(Constant::MSG_DUPLICATE, Constant::DUPLICATE );
        }

        $conection->select('UPDATE custom_column SET table_id = :id_table, type_id = :type, name= :name WHERE id = :idColumn ', [
            'id_table' => $idTable,
            'type' => $idtype,
            'name' => $name,
            'idColumn'=>$idColumn,
        ]);
    }

    public function deleteCustomColumns($conection, $idColumn)
    {

        $check = $conection->select('SELECT id FROM custom_column WHERE  id = :idColumn',['idColumn'=>$idColumn]);

        if(empty($check)){ 
            throw new \Exception(Constant::MSG_NOT_FOUND, Constant::NOT_FOUND );
        }

        $conection->select('DELETE FROM custom_column WHERE  id = :idColumn',['idColumn'=>$idColumn]);


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


    public function getCustomColumnsByTable($conection, $idTable)
    {
        $type = $conection->select("SELECT t1.*, t2.name name_type from custom_column t1 inner join column_type t2 on t1.type_id = t2.id  WHERE table_id = :idTable",['idTable'=>$idTable]);

        return $type;
    }

    public function getCustomColumnsValuesByIdColumn($conection, $custom_column_id, $idContext)
    {
        $query = "SELECT * from custom_column_value WHERE custom_column_id = :custom_column_id";
        $bind = ['custom_column_id'=>$custom_column_id];

        if($idContext != null && intval($idContext) != -1){
            $query = $query." AND context_id = :context_id ";
            $bind['context_id'] = $idContext;
        }

        $type = $conection->select($query,$bind);

        return $type;
    }

    public function getElementsView($conection)
    {
       return $conection->select('SELECT * FROM column_type');
    }
}

