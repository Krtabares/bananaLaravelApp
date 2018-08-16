<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class UnitBnImplement
{
	public function selectUnits($conection)
	{
		return $conection->select('SELECT * FROM units ORDER BY tag');
	}

	public function createUnit($conection, $tag, $quantity)
	{
		$unit_id = $conection->select('CALL CR_InsertUnits(:tag, :quantity)',[
			'tag' => $tag,
			'quantity' => $quantity
		]);

		return $unit_id[0]->LID;
	}

	public function updateUnit($conection, $id, $tag, $quantity)
	{
		$conection->select('CALL UP_UpdateUnits(:id, :tag, :quantity)', [
			'id' => $id,
			'tag' => $tag,
			'quantity' => $quantity
		]);

		$contact = $conection->select('SELECT * FROM units WHERE id = :id', [
			'id' => $id
		]);

		return $contact[0];
	}

	public function archivedUnit($conection, $id, $archived)
	{
		$conection->select('CALL DL_ArchivedUnits(:id, :archived)', [
			'id' => $id,
			'archived' => $archived
		]);

		$contact = $conection->select('SELECT * FROM units WHERE id = :id', [
			'id' => $id
		]);

		return $contact[0];
	}

	public function deleteUnit($conection, $id)
	{
		$conection->select('CALL DL_DeleteUnit(:id)', [
			'id' => $id
		]);

		$delete = $conection->select('SELECT * FROM units WHERE id = :id', [
			'id' => $id
		]);

		return $result = ($delete == null) ? 1 : 0 ;
	}
}
