<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;
use App\Http\BnImplements\LocationBnImplement;
use App\Http\BnImplements\ContactBnImplement;
use App\Http\BnImplements\CustomColumnsBnImplement;

class ThirdBnImplement
{
	private $location_implement;
	private $contact_implement;
	private $CustomColums_implement;

	function __construct(
		LocationBnImplement $location_implement,
		ContactBnImplement $contact_implement,
		CustomColumnsBnImplement $CustomColums_implement
	)
	{
		$this->location_implement = $location_implement;
		$this->contact_implement = $contact_implement;
		$this->CustomColums_implement = $CustomColums_implement;
	}

	public function selectThirds($conection)
	{
		return $conection->select('SELECT DISTINCT b.name, b.id, b.reference_no, bl.phone, bl.phone_2
			FROM bpartners b
			INNER JOIN bpartner_locations bl ON b.id = bl.bpartner_id
			ORDER BY b.updated_at DESC'
		);
	}

	public function selectFilterThirds($conection, $search)
	{
		return $conection->select('CALL RD_SelectFilteredThirds(:search)', ['search' => $search]);
	}

	public function comboSelect($conection)
	{
		$client = $conection->select('SELECT * FROM clients');

		$org_list = $conection->select('SELECT id, name
			FROM organizations
			ORDER BY name ASC');

		$language_list = $conection->select('SELECT id, languagescol
			FROM languages
			ORDER BY languagescol ASC');

		$sales_rep = $conection->select('SELECT id, name
			FROM bpartners
			WHERE is_sales_rep = 1
			ORDER BY name ASC');

		return [
			'client' => $client[0],
			'sales_representatives' => $sales_rep,
			'organizations' => $org_list,
			'languages' => $language_list
		];
	}

	public function selectThirdById($conection, $third_id)
	{
		$third = $conection->select('SELECT * FROM bpartners
			WHERE id = :third_id', [
			'third_id' => $third_id
		]);

		$branch_office = $conection->select('SELECT * FROM bpartner_locations
			WHERE bpartner_id = :third_id
			ORDER BY id ASC
			LIMIT 1', [
			'third_id' => $third_id
		]);

		$location = $conection->select('SELECT * FROM locations
			WHERE id = :location_id', [
			'location_id' => $branch_office[0]->location_id
		]);

		$third_contacts = $this->selectThirdContacts($conection, $third_id);

		$branch_offices = $this->selectBranchOffice($conection, $third_id);

		return [
			'third' => $third[0],
			'branch_office' => $branch_office[0],
			'branch_offices' => $branch_offices,
			'location' => $location[0],
			'third_contacts' => $third_contacts
		];
	}

	public function insertThird(
		$conection,
		$org_id,
		$logo,
		$customer,
		$vendor,
		$name,
		$name_2,
		$employee,
		$prospect,
		$sales_rep,
		$reference_no,
		$sales_rep_id,
		$credit_status,
		$credit_limit,
		$tax_id,
		$tax_exempt,
		$pot_tax_exempt,
		$url,
		$description,
		$summary,
		$price_list_id,
		$delivery_rule,
		$delivery_via_rule,
		$flat_discount,
		$manufacturer,
		$po_price_list_id,
		$language_id,
		$greeting_id,
		$third_location,
		$branch_office
	)
	{

		$lid = $conection->select('CALL CR_InsertBpartners(
				:org_id,
				:logo,
				:customer,
				:vendor,
				:name,
				:name_2,
				:employee,
				:prospect,
				:sales_rep,
				:reference_no,
				:sales_rep_id,
				:credit_status,
				:credit_limit,
				:tax_id,
				:tax_exempt,
				:pot_tax_exempt,
				:url,
				:description,
				:summary,
				:price_list_id,
				:delivery_rule,
				:delivery_via_rule,
				:flat_discount,
				:manufacturer,
				:po_price_list_id,
				:language_id,
				:greeting_id
			)', [
					'org_id' => $org_id,
					'logo' => $logo,
					'customer' => $customer,
					'vendor' => $vendor,
					'name' => $name,
					'name_2' => $name_2,
					'employee' => $employee,
					'prospect' => $prospect,
					'sales_rep' => $sales_rep,
					'reference_no' => $reference_no,
					'sales_rep_id' => $sales_rep_id,
					'credit_status' => $credit_status,
					'credit_limit' => $credit_limit,
					'tax_id' => $tax_id,
					'tax_exempt' => $tax_exempt,
					'pot_tax_exempt' => $pot_tax_exempt,
					'url' => $url,
					'description' => $description,
					'summary' => $summary,
					'price_list_id' => $price_list_id,
					'delivery_rule' => $delivery_rule,
					'delivery_via_rule' => $delivery_via_rule,
					'flat_discount' => $flat_discount,
					'manufacturer' => $manufacturer,
					'po_price_list_id' => $po_price_list_id,
					'language_id' => $language_id,
					'greeting_id' => $greeting_id
				]
			);

		$location_insert = $this->location_implement
			->insertLocation(
				$conection, $third_location['address_1'],
				$third_location['address_2'], $third_location['address_3'],
				$third_location['address_4'], $third_location['city_id'],
				$third_location['city_name'], $third_location['postal'],
				$third_location['postal_add'], $third_location['state_id'],
				$third_location['state_name'], $third_location['country_id'],
				$third_location['comments']
			);

		$branch_office_insert = $this->insertBranchOffice(
			$conection, $lid[0]->LID, $location_insert->id,
			$name, 1, 1, 1, 1, $branch_office['phone'],
			$branch_office['phone_2'], '', ''
		);

		return [
			'third' => $lid[0]->LID,
			'location' => $location_insert,
			'branch_office' => $branch_office_insert
		];
	}

	public function updateThird(
		$conection,
		$third_id,
		$org_id,
		$logo,
		$customer,
		$vendor,
		$name,
		$name_2,
		$employee,
		$prospect,
		$sales_rep,
		$reference_no,
		$sales_rep_id,
		$credit_status,
		$credit_limit,
		$tax_id,
		$tax_exempt,
		$pot_tax_exempt,
		$url,
		$description,
		$summary,
		$price_list_id,
		$delivery_rule,
		$delivery_via_rule,
		$flat_discount,
		$manufacturer,
		$po_price_list_id,
		$language_id,
		$greeting_id,
		$third_location,
		$branch_office
	)
	{

		$conection->select('CALL UP_UpdateBpartners(
				:third_id,
				:org_id,
				:logo,
				:customer,
				:vendor,
				:name,
				:name_2,
				:employee,
				:prospect,
				:sales_rep,
				:reference_no,
				:sales_rep_id,
				:credit_status,
				:credit_limit,
				:tax_id,
				:tax_exempt,
				:pot_tax_exempt,
				:url,
				:description,
				:summary,
				:price_list_id,
				:delivery_rule,
				:delivery_via_rule,
				:flat_discount,
				:manufacturer,
				:po_price_list_id,
				:language_id,
				:greeting_id
			)', [
					'third_id' => $third_id,
					'org_id' => $org_id,
					'logo' => $logo,
					'customer' => $customer,
					'vendor' => $vendor,
					'name' => $name,
					'name_2' => $name_2,
					'employee' => $employee,
					'prospect' => $prospect,
					'sales_rep' => $sales_rep,
					'reference_no' => $reference_no,
					'sales_rep_id' => $sales_rep_id,
					'credit_status' => $credit_status,
					'credit_limit' => $credit_limit,
					'tax_id' => $tax_id,
					'tax_exempt' => $tax_exempt,
					'pot_tax_exempt' => $pot_tax_exempt,
					'url' => $url,
					'description' => $description,
					'summary' => $summary,
					'price_list_id' => $price_list_id,
					'delivery_rule' => $delivery_rule,
					'delivery_via_rule' => $delivery_via_rule,
					'flat_discount' => $flat_discount,
					'manufacturer' => $manufacturer,
					'po_price_list_id' => $po_price_list_id,
					'language_id' => $language_id,
					'greeting_id' => $greeting_id
				]
			);

		$third_udpate = $conection->select('SELECT * FROM bpartners WHERE id = :third_id', [
			'third_id' => $third_id
		]);

		$location_update = $this->location_implement
			->updateLocation(
				$conection, $third_location['id'], $third_location['address_1'],
				$third_location['address_2'], $third_location['address_3'],
				$third_location['address_4'], $third_location['city_id'],
				$third_location['city_name'], $third_location['postal'],
				$third_location['postal_add'], $third_location['state_id'],
				$third_location['state_name'], $third_location['country_id'],
				$third_location['comments']
			);

		$branch_office_update = $this->updateBranchOffice(
			$conection, $branch_office['id'],
			$branch_office['name'], $branch_office['is_ship_to'], $branch_office['is_bill_to'],
			$branch_office['is_pay_from'], $branch_office['is_remit_to'], $branch_office['phone'],
			$branch_office['phone_2'], $branch_office['fax'], $branch_office['isdn']
		);

		return [
			'third' => $third_udpate[0],
			'location' => $location_update,
			'branch_office' => $branch_office_update
		];
	}

	public function archivedThird($conection, $third_id, $archived)
	{
		$conection->select('CALL DL_ArchivedThird(:third_id, :archived)', [
			'third_id' => $third_id,
			'archived' => $archived
		]);

		return $conection->select('SELECT * FROM bpartners
			WHERE id = :third_id', [
				'third_id' => $third_id
			]);
	}

	public function deleteThird($conection, $third_id, $location_id)
	{
		$conection->select('CALL DL_DeleteBpartnerData(:third_id, :location_id)', [
			'third_id' => $third_id,
			'location_id' => $location_id
		]);

		$delete = $conection->select('SELECT * FROM bpartners WHERE id = :third_id', [
			'third_id' => $third_id
		]);

		return $result = ($delete == null) ? 1 : 0 ;
	}

	public function selectBranchOffice($conection, $id)
	{
		$branch_office = $conection->select('SELECT * FROM bpartner_locations where bpartner_id = :id', [
			'id' => $id
		]);

		return $branch_office;
	}

	public function insertBranchOffice($conection, $third_id, $location_id,
		$name, $is_ship_to, $is_bill_to, $is_pay_from, $is_remit_to, $phone,
		$phone_2, $fax, $isdn)
	{

		$conection->select('CALL CR_InsertBpartnerLocation(
				:third_id,
				:location_id,
				:name,
				:is_ship_to,
				:is_bill_to,
				:is_pay_from,
				:is_remit_to,
				:phone,
				:phone_2,
				:fax,
				:isdn
			)', [
					'third_id' => $third_id,
					'location_id' => $location_id,
					'name' => $name,
					'is_ship_to' => $is_ship_to,
					'is_bill_to' => $is_bill_to,
					'is_pay_from' => $is_pay_from,
					'is_remit_to' => $is_remit_to,
					'phone' => $phone,
					'phone_2' => $phone_2,
					'fax' => $fax,
					'isdn' => $isdn
				]
			);

		$branch_insert = $conection->select('
			SELECT *
			FROM bpartner_locations
			ORDER BY id DESC
			LIMIT 1'
		);

		return $branch_insert[0];
	}

	public function updateBranchOffice($conection, $branch_office_id,
		$name, $is_ship_to, $is_bill_to, $is_pay_from, $is_remit_to, $phone,
		$phone_2, $fax, $isdn)
	{

		$conection->select('CALL UP_UpdateBpartnerLocation(
				:branch_office_id,
				:name,
				:is_ship_to,
				:is_bill_to,
				:is_pay_from,
				:is_remit_to,
				:phone,
				:phone_2,
				:fax,
				:isdn
			)', [
					'branch_office_id' => $branch_office_id,
					'name' => $name,
					'is_ship_to' => $is_ship_to,
					'is_bill_to' => $is_bill_to,
					'is_pay_from' => $is_pay_from,
					'is_remit_to' => $is_remit_to,
					'phone' => $phone,
					'phone_2' => $phone_2,
					'fax' => $fax,
					'isdn' => $isdn
				]
			);

		$branch_update = $conection->select('
			SELECT *
			FROM bpartner_locations
			WHERE id = :branch_office_id', [
			'branch_office_id' => $branch_office_id
		]);

		return $branch_update[0];
	}

	public function selectThirdContacts($conection, $third_id)
	{
		return $conection->select('SELECT c.* FROM contacts c
			JOIN bpartner_contact b_c ON b_c.contact_id = c.id
			JOIN bpartners b ON b.id = b_c.bpartner_id
			WHERE b.id = :third_id
			ORDER BY c.title ASC;', [
			'third_id' => $third_id
		]);
	}

	public function insertThirdContact(
		$conection,
		$third_id,
		$name,
		$description,
		$comments,
		$email,
		$phone,
		$phone_2,
		$fax,
		$title,
		$birthday,
		$last_contact,
		$last_result
	)
	{
		$contact_insert = $this->contact_implement->insertContact(
			$conection,
			$name,
			$description,
			$comments,
			$email,
			$phone,
			$phone_2,
			$fax,
			$title,
			$birthday,
			$last_contact,
			$last_result
		);

		$conection->select('CALL CR_InsertBpartnerContact(:third_id, :contact_id)',[
			'third_id' => $third_id,
			'contact_id' => $contact_insert->id
		]);

		return ['contact' => $contact_insert];
	}

	public function deleteThirdContact ($conection, $contact_id, $third_id) {

		$conection->select('CALL DL_BpartnerContactRelation(:third_id, :contact_id)',[
			'third_id' => $third_id,
			'contact_id' => $contact_id
		]);

		$delete = $conection->select('SELECT * FROM bpartner_contact
		WHERE bpartner_id = :third_id AND contact_id = :contact_id', [
			'third_id' => $third_id,
			'contact_id' => $contact_id
		]);

		return $result = ($delete == null) ? 1 : 0 ;
	}


}
