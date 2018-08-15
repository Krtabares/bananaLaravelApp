<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class StateBnImplement
{
	public function selectStates($conection)
    {
        return $conection->raw('SELECT c.country, s.*
            FROM states s, countries c
            WHERE c.id = s.country_id
            ORDER BY c.country, s.state;');
    }

    public function selectIdNameStates($conection, $country_id)
    {
        return $conection->raw('SELECT id, state FROM states
            WHERE country_id = :country_id
            ORDER BY state;', [
            'country_id' => $country_id
        ]);
    }

    public function selectFilterStates($conection, $search)
    {
        return $conection->raw('CALL RD_SelectFilteredStates(:search)',
        	['search' => $search]
        );
    }

    public function insertState($conection, $country_id, $state_name, $iso)
    {
        $conection->raw('CALL CR_InsertState(:country_id, :state_name, :iso)', [
                'state_name' => $state_name,
                'country_id' => $country_id,
                'iso' => $iso
            ]);

        return $conection->raw('SELECT c.country, s.* FROM countries c, states s
            WHERE c.id = s.country_id ORDER BY id DESC LIMIT 1');
    }

    public function updateState($conection, $state_id, $country_id, $state_name, $iso)
    {
        $conection->raw('CALL UP_UpdateState(:state_id, :country_id, :state_name, :iso)', [
        		'state_id' => $state_id,
                'country_id' => $country_id,
                'state_name' => $state_name,
                'iso' => $iso
            ]);

        return $conection->raw('SELECT c.country, s.* FROM countries c, states s
            WHERE c.id = s.country_id AND s.id = :state_id', [
                'state_id' => $state_id
            ]);
    }

    public function archivedState($conection, $state_id, $archived)
    {
        $conection->raw('CALL DL_ArchivedState(:state_id, :archived)', [
            'state_id' => $state_id,
            'archived' => $archived
        ]);

        return $conection->raw('SELECT c.country, s.* FROM countries c, states s
            WHERE c.id = s.country_id AND s.id = :state_id', [
                'state_id' => $state_id
            ]);
	}
}