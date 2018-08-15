<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class ManufacturerBnImplement
{
	public function selectManufacturers($conection)
	{
		return $conection->raw('SELECT * FROM manufacturers ORDER BY updated_at DESC');
	}

	public function createManufacturer($conection, $name)
	{
		$manufacturer = $conection->raw('CALL CR_InsertManufacturer(:name)',[
			'name' => $name
		]);

		return $manufacturer[0]->LID;
	}

	public function updateManufacturer($conection, $id, $name)
	{
		$conection->raw('CALL UP_UpdateManufacturer(:id, :name)', [
			'id' => $id,
			'name' => $name
		]);

		$manufacturer = $conection->raw('SELECT * FROM manufacturers WHERE id = :id', [
			'id' => $id
		]);

		return $manufacturer[0];
	}

	public function archivedManufacturer($conection, $id, $archived)
	{
		$conection->raw('CALL DL_ArchivedManufacturer(:id, :archived)', [
			'id' => $id,
			'archived' => $archived
		]);

		$manufacturer = $conection->raw('SELECT * FROM manufacturers WHERE id = :id', [
			'id' => $id
		]);

		return $manufacturer[0];
	}

	public function deleteManufacturer($conection, $id)
	{
		$conection->raw('CALL DL_DeleteManufacturer(:id)', [
			'id' => $id
		]);

		$delete = $conection->raw('SELECT * FROM manufacturers WHERE id = :id', [
			'id' => $id
		]);

		return $result = ($delete == null) ? 1 : 0 ;
	}
}