<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class LocationBnImplement
{
	public function insertLocation($conection, $address_1, $address_2, 
			$address_3, $address_4, $city_id, $city_name, $postal, $postal_add,
			$state_id, $state_name, $country_id, $comments)
	{
		$conection->select('CALL CR_InsertLocation(:address_1, :address_2, 
			:address_3, :address_4, :city_id, :city_name, :postal, :postal_add,
			:state_id, :state_name, :country_id, :comments)', [
			'address_1' => $address_1,
			'address_2' => $address_2,
			'address_3' => $address_3,
			'address_4' => $address_4,
			'city_id' => $city_id,
			'city_name' => $city_name,
			'postal' => $postal,
			'postal_add' => $postal_add,
			'state_id' => $state_id,
			'state_name' => $state_name,
			'country_id' => $country_id,
			'comments' => $comments
		]);

		$location_insert = $conection->select('SELECT * FROM locations ORDER BY id DESC LIMIT 1');

    	return $location_insert[0];
	}
}