<?php

namespace App\Http\BnImplements;

use App\Constant;
use App\User;
use Illuminate\Support\Facades\DB;
use App\BananaUtils\SessionToken;
class CustomColumnsBnImplement
{


    function __construct()
    {

    }



    public function insertCustomColumns($conection, $type, $name)
    {
        $conection->select('CALL CR_InsertCustomColumn(:type, :name)', [
            'user_id' => $type,
            'name' => $name
        ]);
    }

    public function insertCustomColumnsValue($conection, $number_value, $string_value, $date_value, $custom_column_id, $context_id)
    {
        $conection->select('CALL CR_InsertCustomColumnValue(:number_value, :string_value, :date_value, :custom_column_id, :context_id)', [
            'number_value' => $number_value,
            'string_value' => $string_value,
            'date_value' => $date_value,
            'custom_column_id' => $custom_column_id,
            'context_id' => $context_id
        ]);
    }
}

