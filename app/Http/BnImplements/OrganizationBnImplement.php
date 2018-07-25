<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class OrganizationBnImplement
{
	public function listOrganizations($conection)
	{
		return $conection->select('SELECT id, organization_name
			FROM organizations
			ORDER BY organization_name ASC');
	}

	public function selectOrganizations($conection)
	{
		$organizations = $conection->select('SELECT * FROM organizations ORDER BY updated_at');
		return $organizations[0];
	}

	public function createOrganization($conection, $name, $ref_num, $description)
	{
		$organization = $conection->select('CALL CR_InsertOrganization(
			:name, :ref_num, :description)', [
				'name' => $name,
				'ref_num' => $ref_num,
				'description' => $description
			]);
		
		return $organization[0]->LID;
	}

	public function updateOrganization($conection, $id, $name, $ref_num, $description)
	{
		$conection->select('CALL UP_UpdateOrganization(
			:id, :name, :ref_num, :description
		)', [
			'id' => $id,
			'name' => $name,
			'ref_num' => $ref_num,
			'description' => $description
		]);

		$organization = $conection->select('SELECT * FROM organizations WHERE id = :id',[
			'id' => $id
		]);

		return $organization[0];
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