<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;


class ProductBnImplement
{


	function __construct()
	{
		
	}


	public function filterProduct($connection, $keyword = NULL, $status = 0){}
	{
		$query = ' SELECT t1.* FROM products t1 WHERE ';
		$bind=[];
		

		if ($keyword != null &&  count(trim($keyword))>1 ) {
		 	$query.=" t1.name like CONCAT('%',:keyword,'%')
		 	OR t1.description like CONCAT('%',:keyword,'%')
		 	OR t1.id = CAST(:keyword AS SIGNED) AND ";
		 	$bind['keyword']=$keyword;
		 }

		 $query .= " archived = :status ";
		 $bind['status'] = $status;

		 
		 return $connection->select($query, $bind);


	}

}