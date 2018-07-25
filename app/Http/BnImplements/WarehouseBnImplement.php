<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class WarehouseBnImplement {

    public function selectWarehouses($conection)
	{
		return $conection->select('SELECT * FROM warehouses ORDER BY updated_at DESC');
	}

    public function createWarehouse($conection, $reference, $name, $warehouses_col, $notes)
    {
        $warehouse = $conection->select('CALL CR_InsertWarehouse(:reference, :name, :warehouses_col, :notes)',[
            'reference' => $reference,
            'name' => $name,
            'warehouses_col' => $warehouses_col,
            'notes' => $notes
        ]);

        return $warehouse[0]->LID;
    }

    public function updateWarehouse($conection, $id, $reference, $name, $warehouses_col, $notes)
    {
        $conection->select('CALL UP_UpdateWarehouse(:id, :reference, :name, :warehouses_col, :notes)', [
            'id' => $id,
            'reference' => $reference,
            'name' => $name,
            'warehouses_col' => $warehouses_col,
            'notes' => $notes
        ]);

        $warehouse = $conection->select('SELECT * FROM warehouses WHERE id = :id', [
            'id' => $id
        ]);

        return $warehouse[0];
    }

    public function deleteWarehouse($conection, $id)
    {
        $conection->select('CALL DL_DeleteWarehouse(:id)', [
            'id' => $id
        ]);

        $delete = $conection->select('SELECT * FROM warehouses WHERE id = :id', [
            'id' => $id
        ]);

        return $result = ($delete == null) ? 1 : 0 ;
    }
}
