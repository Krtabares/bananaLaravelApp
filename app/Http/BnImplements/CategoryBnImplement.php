<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class CategoryBnImplement
{
	public function selectCategories($conection)
	{
		return $conection->raw('SELECT * FROM categories ORDER BY updated_at DESC');
	}

	public function createCategory($conection, $name, $color, $parent_id)
	{
		$category = $conection->raw('CALL CR_InsertCategory(:name, :color, :parent_id)',[
			'name' => $name,
			'color' => $color,
			'parent_id' => $parent_id
		]);

		return $category[0]->LID;
	}

	public function updateCategory($conection, $id, $name, $color, $parent_id)
	{
		$conection->raw('CALL UP_UpdateCategory(:id, :name, :color, :parent_id)', [
			'id' => $id,
			'name' => $name,
			'color' => $color,
			'parent_id' => $parent_id
		]);

		$category = $conection->raw('SELECT * FROM categories WHERE id = :id', [
			'id' => $id
		]);

		return $category[0];
	}

	public function archivedCategory($conection, $id, $archived)
	{
		$conection->raw('CALL DL_ArchivedCategory(:id, :archived)', [
			'id' => $id,
			'archived' => $archived
		]);

		$category = $conection->raw('SELECT * FROM categories WHERE id = :id', [
			'id' => $id
		]);

		return $category[0];
	}

	public function deleteCategory($conection, $id)
	{
		$conection->raw('CALL DL_DeleteCategory(:id)', [
			'id' => $id
		]);

		$delete = $conection->raw('SELECT * FROM categories WHERE id = :id', [
			'id' => $id
		]);

		return $result = ($delete == null) ? 1 : 0 ;
	}
}