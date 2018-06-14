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
}