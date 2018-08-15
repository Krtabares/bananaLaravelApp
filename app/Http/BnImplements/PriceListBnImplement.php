<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class PriceListBnImplement
{
	public function selectPriceLists($conection)
	{
		return $conection->raw('SELECT * FROM price_lists ORDER BY updated_at DESC');
	}

	public function createPriceList($conection,$reference,$name,$valid_from,$valid_until,$tax_include,$currency_id
	)
	{
		$price_list = $conection->raw('CALL CR_InsertPriceList(
				:reference,
				:name,
				:valid_from,
				:valid_until,
				:tax_include,
				:currency_id
			)',
			[
				'reference' => $reference,
				'name' => $name,
				'valid_from' => $valid_from,
				'valid_until' => $valid_until,
				'tax_include' => $tax_include,
				'currency_id' => $currency_id
			]
		);

		return $price_list[0]->LID;
	}

	public function updatePriceList(
		$conection,
		$id,
		$reference,
		$name,
		$valid_from,
		$valid_until,
		$tax_include,
		$currency_id
	)
	{
		$conection->raw('CALL UP_UpdatePriceList(
				:id,
				:reference,
				:name,
				:valid_from,
				:valid_until,
				:tax_include,
				:currency_id
			)',
			[
				'id' => $id,
				'reference' => $reference,
				'name' => $name,
				'valid_from' => $valid_from,
				'valid_until' => $valid_until,
				'tax_include' => $tax_include,
				'currency_id' => $currency_id
			]
		);

		$price_list = $conection->raw('SELECT * FROM price_lists WHERE id = :id', [
			'id' => $id
		]);

		return $price_list[0];
	}

	public function deletePriceList($conection, $id)
	{
		$conection->raw('CALL DL_DeletePriceList(:id)', [
			'id' => $id
		]);

		$delete = $conection->raw('SELECT * FROM price_lists WHERE id = :id', [
			'id' => $id
		]);

		return $result = ($delete == null) ? 1 : 0 ;
	}
}