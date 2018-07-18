<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;


class ProductBnImplement
{


	function __construct()
	{
		
	}


	public function filterProduct($connection, $keyword = NULL, $status = 0)
	{
		$query = " SELECT t1.*, t2.tag 'condition', t3.tag 'unit', t3.quantity  FROM products t1 
		left join conditions t2 ON t1.condition_id = t2.id
		left join units t3 ON t1.unit_id = t3.id
		WHERE ";
		$bind=[];
		

		if ($keyword != null &&  count(trim($keyword))>1 ) {
		 	$query.=" t1.name like CONCAT('%',:keyword,'%')
		 	OR t1.description like CONCAT('%',:keyword,'%')
		 	OR t1.id = CAST(:keyword AS SIGNED) AND ";
		 	$bind['keyword']=$keyword;
		 }

		 $query .= " t1.archived = :status ";
		 $bind['status'] = $status;


		 return $connection->select($query, $bind);

	}

	public function saveProduct($connection, $product)
	{
		$connection->select('CALL CR_InsertProduct(
		 :sku,
		 :ean13,
		 :upc,
		 :archived,
		 :name,
		 :description,
		 :type,
		 :is_salable,
		 :is_purchasable,
		 :condition_id,
		 :unit_id,
		 :manufacture_id,
		 :price_list_id)',
		 [
            'sku'=>$product->sku
			'ean13'=>$product->ean13,
			'upc'=>$product->,
			'archived'=>$product->archived,
			'name'=>$product->name,
			'description'=>$product->description,
			'type'=>$product->type,
			'is_salable'=>$product->is_salable,
			'is_purchasable'=>$product->is_purchasable,
			'condition_id'=>$product->condition_id,
			'unit_id'=>$product->unit_id,
			'manufacture_id'=>$product->manufacture_id,
			'price_list_id'=>$product->price_list_id
        ]);	
	}

}