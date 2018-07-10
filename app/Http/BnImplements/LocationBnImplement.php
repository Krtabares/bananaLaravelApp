<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;
use App\Http\BnImplements\CountryBnImplement;
use App\Http\BnImplements\StateBnImplement;
use App\Http\BnImplements\CityBnImplement;

class LocationBnImplement
{
	public $country_implement;
	public $state_implement;
	public $city_implement;

	function __construct(
		CountryBnImplement $country_implement,
		StateBnImplement $state_implement,
		CityBnImplement $city_implement
	)
	{
		$this->country_implement = $country_implement;
		$this->state_implement = $state_implement;
		$this->city_implement = $city_implement;
	}


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

	public function updateLocation($conection, $location_id, $address_1, $address_2, 
			$address_3, $address_4, $city_id, $city_name, $postal, $postal_add,
			$state_id, $state_name, $country_id, $comments)
	{
		$conection->select('CALL UP_UpdateLocation(:location_id, :address_1, :address_2, 
			:address_3, :address_4, :city_id, :city_name, :postal, :postal_add,
			:state_id, :state_name, :country_id, :comments)', [
			'location_id' => $location_id,
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

		$location_update = $conection->select('
			SELECT * 
			FROM locations 
			WHERE id = :location_id', [
			'location_id' => $location_id
		]);

		return $location_update[0];
	}
}