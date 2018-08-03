<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class BananaMigrationsBnImplement
{

	public function selectColumnsClients($conection)
    {
        return $conection->select("SELECT t1.id id_column, t1.column_name, t2.table_name , (if(t3.required is null,0, t3.required)) as required, 0 as selected  from columns t1
                left join tables t2 ON t1.table_id = t2.id
                left join field_configurations t3 ON t1.id = t3.column_id
                    where (table_id = 17 or table_id = 21)  and t1.column_name not like 'organization_id'  and t1.column_name not like 'id' and t1.column_name not like 'updated_at'");
    }

}
