<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;
use App\Http\BnImplements\LocationBnImplement;
use App\Http\BnImplements\ContactBnImplement;

class OrganizationBnImplement
{
	private $location_implement;
	private $contact_implement;

	function __construct(
		LocationBnImplement $location_implement,
		ContactBnImplement $contact_implement
	)
	{
		$this->location_implement = $location_implement;
		$this->contact_implement = $contact_implement;
	}

	public function listOrganizations($conection)
	{
		return $conection->select('SELECT id, organization_name
			FROM organizations
			ORDER BY organization_name ASC');
	}

	public function selectOrganizations($conection)
	{
		$organizations = $conection->select('SELECT * FROM organizations ORDER BY updated_at');
		return $organizations;
	}

	public function selectOrganizationById($conection, $organization_id)
	{
		$organization = $conection->select('SELECT * FROM organizations
			WHERE id = :organization_id', [
			'organization_id' => $organization_id
		]);

		$location = $conection->select('SELECT * FROM locations
			WHERE id = :location_id', [
			'location_id' => $organization[0]->location_id
		]);

		return [
			'organization' => $organization[0],
			'localization' => $result = ($location != null) ? $location[0] : null
		];
	}

	public function createOrganization($conection, $name, $ref_num, $description, $organization_location)
	{
		$location = $this->location_implement
		->insertLocation(
			$conection, $organization_location['address_1'], 
			$organization_location['address_2'], $organization_location['address_3'],
			$organization_location['address_4'], $organization_location['city_id'],
			$organization_location['city_name'], $organization_location['postal'],
			$organization_location['postal_add'], $organization_location['state_id'],
			$organization_location['state_name'], $organization_location['country_id'],
			$organization_location['comments']
		);

		$organization = $conection->select('CALL CR_InsertOrganization(
			:name, :ref_num, :description, :location_id)', [
				'name' => $name,
				'ref_num' => $ref_num,
				'description' => $description,
				'location_id' => $location->id
			]);
		
		return $organization[0]->LID;
	}

	public function updateOrganization($conection, $id, $name, $ref_num, $description, $organization_location)
	{
		if ($id != 0) {

			$location = $this->location_implement
			->updateLocation(
				$conection, $organization_location['id'], $organization_location['address_1'], 
				$organization_location['address_2'], $organization_location['address_3'],
				$organization_location['address_4'], $organization_location['city_id'],
				$organization_location['city_name'], $organization_location['postal'],
				$organization_location['postal_add'], $organization_location['state_id'],
				$organization_location['state_name'], $organization_location['country_id'],
				$organization_location['comments']
			);

		} else {

			$location = $this->location_implement
			->insertLocation(
				$conection, $organization_location['address_1'], 
				$organization_location['address_2'], $organization_location['address_3'],
				$organization_location['address_4'], $organization_location['city_id'],
				$organization_location['city_name'], $organization_location['postal'],
				$organization_location['postal_add'], $organization_location['state_id'],
				$organization_location['state_name'], $organization_location['country_id'],
				$organization_location['comments']
			);
			
		}

		$conection->select('CALL UP_UpdateOrganization(
			:id, :name, :ref_num, :description, :location_id
		)', [
			'id' => $id,
			'name' => $name,
			'ref_num' => $ref_num,
			'description' => $description,
			'location_id' => $location->id
		]);

		$organization = $conection->select('SELECT * FROM organizations WHERE id = :id',[
			'id' => $id
		]);

		return [
			'organization' => $organization[0],
			'localization' => $location
		];
	}

	public function archivedOrganization($conection, $id, $archived)
	{
		$conection->select('CALL DL_ArchivedOrganization(:id, :archived)', [
			'id' => $id,
			'archived' => $archived
		]);

		$organization = $conection->select('SELECT * FROM organizations WHERE id = :id',[
			'id' => $id
		]);

		return $organization[0];
	}

	public function deleteOrganization($conection, $id)
	{
		$conection->select('CALL DL_DeleteOrganization(:id)', [
			'id' => $id
		]);

		$delete = $conection->select('SELECT * FROM organizations WHERE id = :id', [
			'id' => $id
		]);

		return $result = ($delete == null) ? 1 : 0 ;
	}
}