<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class ConditionBnImplement
{
	public function selectConditions($conection)
	{
		return $conection->select('SELECT * FROM conditions ORDER BY updated_at DESC');
	}

	public function createCondition($conection, $tag)
	{
		$condition = $conection->select('CALL CR_InsertCondition(:tag)',[
			'tag' => $tag
		]);

		return $condition[0]->LID;
	}

	public function updateCondition($conection, $id, $tag)
	{
		$conection->select('CALL UP_UpdateCondition(:id, :tag)', [
			'id' => $id,
			'tag' => $tag
		]);

		$condition = $conection->select('SELECT * FROM conditions WHERE id = :id', [
			'id' => $id
		]);

		return $condition[0];
	}

	public function deleteCondition($conection, $id)
	{
		$conection->select('CALL DL_DeleteCondition(:id)', [
			'id' => $id
		]);

		$delete = $conection->select('SELECT * FROM conditions WHERE id = :id', [
			'id' => $id
		]);

		return $result = ($delete == null) ? 1 : 0 ;
	}
}