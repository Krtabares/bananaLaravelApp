<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class CategoryBnImplement
{
	public function selectCategories($conection)
	{
		return $conection->select('SELECT * FROM categories ORDER BY tag');
	}

	public function createCategory($conection, $tag, $color, $category_id)
	{
		$category_id = $conection->select('CALL CR_InsertCategory(:tag, :color, :parent_id)',[
			'tag' => $tag,
			'color' => $color,
			'parent_'
		]);

		return $category_id[0]->LID;
	}

	/*

	public function updateUnit($conection, $id, $tag, $quantity)
	{
		$conection->select('CALL UP_UpdateCategory(:id, :tag, :quantity)', [
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
		$conection->select('CALL DL_ArchivedCategory(:id, :archived)', [
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
	}*/
}