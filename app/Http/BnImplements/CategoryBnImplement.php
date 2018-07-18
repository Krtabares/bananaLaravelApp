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

	public function createCategory($conection, $tag, $color, $parent_id)
	{
		$category = $conection->select('CALL CR_InsertCategory(:tag, :color, :parent_id)',[
			'tag' => $tag,
			'color' => $color,
			'parent_id' => $parent_id
		]);

		return $category[0]->LID;
	}

	public function updateCategory($conection, $id, $tag, $color, $parent_id)
	{
		$conection->select('CALL UP_UpdateCategory(:id, :tag, :color, :parent_id)', [
			'id' => $id,
			'tag' => $tag,
			'color' => $color,
			'parent_id' => $parent_id
		]);

		$category = $conection->select('SELECT * FROM categories WHERE id = :id', [
			'id' => $id
		]);

		return $category[0];
	}

	public function archivedCategory($conection, $id, $archived)
	{
		$conection->select('CALL DL_ArchivedCategory(:id, :archived)', [
			'id' => $id,
			'archived' => $archived
		]);

		$category = $conection->select('SELECT * FROM categories WHERE id = :id', [
			'id' => $id
		]);

		return $category[0];
	}

	public function deleteCategory($conection, $id)
	{
		$conection->select('CALL DL_DeleteCategory(:id)', [
			'id' => $id
		]);

		$delete = $conection->select('SELECT * FROM categories WHERE id = :id', [
			'id' => $id
		]);

		return $result = ($delete == null) ? 1 : 0 ;
	}
}