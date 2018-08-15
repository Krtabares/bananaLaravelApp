<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class UnitBnImplement
{
	public function selectUnits($conection)
	{
		return $conection->raw('SELECT * FROM units ORDER BY tag');
	}

	public function createUnit($conection, $tag, $quantity)
	{
		$unit_id = $conection->raw('CALL CR_InsertUnits(:tag, :quantity)',[
			'tag' => $tag,
			'quantity' => $quantity
		]);

		return $unit_id[0]->LID;
	}

	public function updateUnit($conection, $id, $tag, $quantity)
	{
		$conection->raw('CALL UP_UpdateUnits(:id, :tag, :quantity)', [
			'id' => $id,
			'tag' => $tag,
			'quantity' => $quantity
		]);

		$contact = $conection->raw('SELECT * FROM units WHERE id = :id', [
			'id' => $id
		]);

		return $contact[0];
	}

	public function archivedUnit($conection, $id, $archived)
	{
		$conection->raw('CALL DL_ArchivedUnits(:id, :archived)', [
			'id' => $id,
			'archived' => $archived
		]);

		$contact = $conection->raw('SELECT * FROM units WHERE id = :id', [
			'id' => $id
		]);

		return $contact[0];
	}

	public function deleteUnit($conection, $id)
	{
		$conection->raw('CALL DL_DeleteUnit(:id)', [
			'id' => $id
		]);

		$delete = $conection->raw('SELECT * FROM units WHERE id = :id', [
			'id' => $id
		]);

		return $result = ($delete == null) ? 1 : 0 ;
	}
}
