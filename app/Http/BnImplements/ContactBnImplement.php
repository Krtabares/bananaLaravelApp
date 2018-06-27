<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class ContactBnImplement
{
	
	function __construct()
	{
		
	}


	public function selectContactById($conection, $contact_id)
	{
		return $conection->select('SELECT * FROM contacts
			WHERE id = :contact_id
			ORDER BY name ASC;', [
			'contact_id' => $contact_id
		]);
	}

	public function insertContact($conection,
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
		$conection->select('CALL CR_InsertContact(
				:name,
				:description,
				:comments,
				:email,
				:phone,
				:phone_2,
				:fax,
				:title,
				:birthday,
				:last_contact,
				:last_result
			)',
			[
				'name' => $name,
				'description' => $description,
				'comments' => $comments,
				'email' => $email,
				'phone' => $phone,
				'phone_2' => $phone_2,
				'fax' => $fax,
				'title' => $title,
				'birthday' => $birthday,
				'last_contact' => $last_contact,
				'last_result' => $last_result
			]
		);

		$contact_insert = $conection->select('SELECT * FROM contact ORDER BY id DESC LIMIT 1');
    	return $contact_insert[0];
	}

	/*public function selectThirdContact($conection, $third_id)
	{
		return $conection->select('SELECT c.* FROM contacts c
			JOIN bpartner_contact b_c ON b_c.contact_id = c.id
			JOIN bpartners b ON b.id = b_c.bpartner_id
			WHERE b.id = :third_id
			ORDER BY c.name ASC;', [
			'third_id' => $third_id
		]);
	}*/
}