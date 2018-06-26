<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class CountryBnImplement
{
	public function selectCountries($conection)
    {
        return $conection->select('SELECT * FROM countries ORDER BY country;');
    }

    public function selectIdNameCountries($conection)
    {
        return $conection->select('SELECT id, country FROM countries ORDER BY country;');
    }

    public function selectFilterCountries($conection, $search)
    {
        return $conection->select('CALL RD_SelectFilteredCountries(:search)',
        		['search' => $search]
        	);
    }

    public function insertCountry($conection, $country_name, $iso)
    {
        $conection->select('CALL CR_InsertCountry(:country_name, :iso)', [
                'country_name' => $country_name,
                'iso' => $iso
            ]);

        return $conection->select('SELECT * FROM countries ORDER BY id DESC LIMIT 1');
    }

    public function updateCountry($conection, $country_id, $country_name, $iso)
    {
        $conection->select('CALL UP_UpdateCountry(:country_id, :country_name, :iso)', [
        		'country_id' => $country_id,
                'country_name' => $country_name,
                'iso' => $iso
            ]);

        return $conection->select('SELECT * FROM countries WHERE id = :country_id',[
            'country_id' => $country_id
        ]);
    }

    public function archivedCountry($conection, $country_id, $archived)
    {
        $conection->select('CALL DL_ArchivedCountry(:country_id, :archived)', [
            'country_id' => $country_id,
            'archived' => $archived
        ]);

        return $conection->select('SELECT * FROM countries WHERE id = :country_id',[
            'country_id' => $country_id
        ]);
	}
}