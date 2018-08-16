<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class TableBnImplement
{

	public function selectColumnsTable($conection, $table_id)
	{
		return $conection->select('CALL RD_SelectColumnsTable(:table_id)',
			['table_id' => $table_id]
		);
	}

}
