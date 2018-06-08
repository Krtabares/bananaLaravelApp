<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class CityBnImplement
{
	public function selectCities($conection)
	{
		return $conection->select('SELECT p.id country_id, p.country, s.state, c.* FROM states s
			JOIN cities c ON s.id = c.state_id
			JOIN countries p ON s.country_id = p.id
			ORDER BY p.country, s.state, c.city');
	}

	public function selectFilterCities($conection, $search)
	{
		return $conection->select('CALL RD_SelectFilteredCities(:search)',[
			'search' => $search
		]);
	}

	public function insertCity($conection, $state_id, $city_name, $capital)
	{
		$conection->select('CALL CR_InsertCity(:state_id, :city_name, :capital)', [
			'state_id' => $state_id,
			'city_name' => $city_name,
			'capital' => $capital
		]);

		return $conection->select('SELECT p.id country_id, p.country, s.state, c.* FROM states s
			JOIN cities c ON s.id = c.state_id
			JOIN countries p ON s.country_id = p.id
			ORDER BY c.id DESC LIMIT 1');
	}

	public function updateCity($conection, $city_id, $state_id, $city_name, $capital)
	{
		$conection->select('CALL UP_UpdateCity(:city_id, :state_id, :city_name, :capital)',[
			'city_id' => $city_id,
			'state_id' => $state_id,
			'city_name' => $city_name,
			'capital' => $capital
		]);

		return $conection->select('SELECT p.id country_id, p.country, s.state, c.* FROM states s
			JOIN cities c ON s.id = c.state_id
			JOIN countries p ON s.country_id = p.id
			WHERE c.id = :city_id', [
				'city_id' => $city_id
			]);
	}
}