<?php

namespace App\Http\BnImplements;

use App\Constant;
use App\User;
use Illuminate\Support\Facades\DB;


class FieldConfigBnImplement
{

  public function getfieldList($conection, $idtable)
  {
       $colums = $this->getColumn($conection, $idtable);

       return $colums;

  }

  public function getColumn($conection, $idtable)
  {
    return $colums =  $conection->raw('
        SELECT t1.id, t1.description name, t3.input_name control_type, t2.position, false as is_custom, t2.input_type_id as id_type FROM columns t1 
        left join field_configurations t2 ON t1.id = t2.column_id
        left join input_types t3 ON t2.input_type_id = t3.id
        WHERE  t1.table_id = :idtable 
        UNION
        SELECT t1.id, t1.name, t3.input_name control_type, t2.position, true as is_custom, t2.input_type_id as id_type FROM custom_column t1 
        left join field_configurations t2 ON t1.id = t2.custom_column_id
        left join input_types t3 ON t2.input_type_id = t3.id
        WHERE  t1.table_id = :idtable2
        ORDER by position '
        ,['idtable'=>$idtable, 'idtable2'=> $idtable]);
  }

  public function insertConfiguration($conection, $inputTypeId, $position, $required = 0 , $columId = null, $customColumId=null )
  {
    $conection->raw(' CALL CR_InsertField(:inputTypeId,:position,:required,:columId, :customColumId)',
      [
        'inputTypeId'=>$inputTypeId,
        'position'=>$position,
        'required'=>$required,
        'columId'=>$columId,
        'customColumId'=> $customColumId
    ]);
  }

  public function UpdateConfiguration($conection, $inputTypeId, $position, $required = 0, $columId = null, $customColumId=null)
  {
    $conection->raw(' CALL UP_UpdateFieldConf(:inputTypeId,:position,:required,:columId, :customColumId)',
      [
        'inputTypeId'=>$inputTypeId,
        'position'=>$position,
        'required'=>$required,
        'columId'=>$columId,
        'customColumId'=> $customColumId
      ]);
  }
      public function getElementsView($conection)
    {
       return $conection->raw('SELECT input_name name, id  FROM input_types');
    }




}

