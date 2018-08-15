<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class ContactBnImplement
{
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
		/*$check = $conection->raw('SELECT id FROM contacts WHERE name = :name LIMIT 1 ;',[
			'name'=>$name
		]);

		if(!empty($check)){ 
			throw new \Exception(Constant::MSG_DUPLICATE, Constant::DUPLICATE );
		}*/

		$id = $conection->raw('CALL CR_InsertContacts(
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
			);',
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

		$contact_insert = $conection->raw('SELECT * FROM contacts WHERE id = :id',[
			'id' => $id[0]->LID
		]);

		return $contact_insert[0];
	}

	public function searchContact($conection, $search)
	{
		return $conection->raw('
			SELECT * FROM contacts WHERE
			`name` LIKE :name ||
			`title` LIKE :title
		',
		[
			'name' => '%'.$search.'%',
			'title' => '%'.$search.'%'
		]);
	}

	public function updateContact($conection,
		$contact_id,
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
		/*$check = $conection->raw('SELECT id FROM contacts
			WHERE name = :name AND id <> :contact_id LIMIT 1 ;',[
			'name' => $name,
			'contact_id' => $contact_id
		]);

		if(!empty($check)){ 
			throw new \Exception(Constant::MSG_DUPLICATE, Constant::DUPLICATE );
		}*/

		$conection->raw('CALL UP_UpdateContact(
				:contact_id,
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
			);',
			[
				'contact_id' => $contact_id,
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

		$contact_update = $conection->raw('
			SELECT * 
			FROM contacts
			WHERE id = :contact_id', [
			'contact_id' => $contact_id
		]);

		return $contact_update[0];
	}

	public function archivedContact($conection, $contact_id, $archived)
	{
		$conection->raw('CALL DL_ArchivedContact(
			:contact_id, :archived
		);',
			[
				'contact_id' => $contact_id,
				'archived' => $archived
			]
		);
		$contact_archived = $conection->raw('SELECT * FROM contacts WHERE id = :id', [
			'id' => $contact_id
		]);
		return $contact_archived[0];
	}

}