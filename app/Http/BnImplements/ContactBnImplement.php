<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class ContactBnImplement
{
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
        $check = $conection->select('SELECT id FROM contacts WHERE name = :name LIMIT 1 ;',[
            'name'=>$name
        ]);

        if(!empty($check)){ 
            throw new \Exception(Constant::MSG_DUPLICATE, Constant::DUPLICATE );
        }

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

		$contact_insert = $conection->select('SELECT * FROM contact ORDER BY id DESC LIMIT 1');

    	return $contact_insert[0];
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
        $check = $conection->select('SELECT id FROM contacts WHERE name = :name LIMIT 1 ;',[
            'name'=>$name
        ]);

        if(!empty($check)){ 
            throw new \Exception(Constant::MSG_DUPLICATE, Constant::DUPLICATE );
        }
        
		$conection->select('CALL UP_UpdateContact(
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

		$contact_update = $conection->select('SELECT * FROM contact WHERE id = :contact_id', [
			'contact_id' => $contact_id
		]);

    	return $contact_update[0];
	}

}