<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class UserBnImplement
{
	public function selectUsers($conection)
	{
		return $conection->select('SELECT users.id, users.rol_id, rols.name rol_name, users.name user_name,
				users.email, users.all_access_organization, users.all_access_column,
				users.archived, users.created_at, users.updated_at
			FROM users, rols
			WHERE rols.id = users.rol_id
			ORDER BY user_name;');
	}

	public function selectUserByid($conection, $user_id)
	{
		$user = $conection->select('SELECT * FROM users WHERE id = :user_id', [
			'user_id' => $user_id
		]);
		$permits = $this->selectPermitsUser($conection, $user_id, 2);

		return ['user' => $user, 'permissions' => $permits];
	}

	public function selectFilterUsers($conection, $search)
	{
		return $conection->select('CALL RD_SelectFilteredUsers(:search)', ['search' => $search]);
	}

	public function selectPermitsUser($conection, $user_id, $type)
	{
		switch (intval($type)) {
			case 0:
				 $functionCall = 'RD_SelectPermitsNotAssociatesUser';
				break;
			case 1:
				 $functionCall = 'RD_SelectPermitsYesAssociatesUser';
				break;
			case 2:
				$functionCall = 'RD_SelectPermitsAssociatesUserAll';
				break;

			default:
				$functionCall = 'RD_SelectPermitsAssociatesUserAll';
				break;
		}

		$permits = $conection->select('CALL '.$functionCall.'(:user_id);',
			['user_id' => $user_id]
		);

		$table_id = 0;
		$index = 0;

		foreach ($permits as $key => $permit) {

			if (  $table_id != $permit->table_id ) {

				$tables[$index]['table_id'] = $permit->table_id;
				$tables[$index]['table_name'] = $permit->table_name;
				$tables[$index]['table_description'] = $permit->table_description;

				$columns['column_id'] = $permit->column_id;
				$columns['column_name'] = $permit->column_name;
				$columns['column_description'] = $permit->column_description;
				$columns['create'] = $permit->create;
				$columns['read'] = $permit->read;
				$columns['update'] = $permit->update;
				$columns['delete'] = $permit->delete;
				$columns['selected'] = $permit->selected;

				$tables[$index]['columns'][] = $columns;

				$table_id = $permit->table_id;
				$index++;

			} elseif ( $table_id == $permit->table_id ) {

				$columns['column_id'] = $permit->column_id;
				$columns['column_name'] = $permit->column_name;
				$columns['column_description'] = $permit->column_description;
				$columns['create'] = $permit->create;
				$columns['read'] = $permit->read;
				$columns['update'] = $permit->update;
				$columns['delete'] = $permit->delete;
				$columns['selected'] = $permit->selected;

				$tables[$index - 1]['columns'][] = $columns;

			}
		}

		return $tables;
	}

	public function insertUser($conection, $rol_id, $user_name, $password, $email)
	{
		$token = 'GENERAR TOKEN';

		$array_object = $conection->select('CALL CR_InsertUser(:rol_id, :user_name, :password,
			:email, :token)', [
				'rol_id' => $rol_id,
				'user_name' => $user_name,
				'password' => md5( $password ),
				'email' => $email,
				'token' => $token
			]);

		return $array_object[0];
	}

	public function updateUser($conection, $user_id, $rol_id, $user_name, $password, $email,
		$all_access_organization, $all_access_column)
	{

		$array_object = $conection->select('CALL UP_UpdateUser(:user_id, :rol_id, :user_name, :password,
			:email, :all_access_organization, :all_access_column)', [
				'user_id' => $user_id,
				'rol_id' => $rol_id,
				'user_name' => $user_name,
				'password' => md5($password)  ,
				'email' => $email,
				'all_access_organization' => $all_access_organization,
				'all_access_column' => $all_access_column
			]);

		return $array_object[0];
	}

	public function archivedUser($conection, $user_id, $archived)
	{
		$array_object = $conection->select('CALL DL_ArchivedUser(:user_id, :archived)', [
			'user_id' => $user_id,
			'archived' => $archived
		]);

		return $array_object[0];
	}

	public function insertPermitsUser($conection, $user_id, $column_id, $create, $read, $update, $delete)
	{
		$conection->select('CALL CR_InsertPermitsUser(:user_id, :column_id, :create, :read, :update, :delete)', [
			'user_id' => $user_id,
			'column_id' => $column_id,
			'create' => $create,
			'read' => $read,
			'update' => $update,
			'delete' => $delete
		]);
	}

	public function updatePermitsUser($conection, $user_id, $column_id, $create, $read, $update, $delete)
	{
		$conection->select('CALL UP_UpdatePermitsUser(:user_id, :column_id, :create, :read, :update, :delete)', [
			'user_id' => $user_id,
			'column_id' => $column_id,
			'create' => $create,
			'read' => $read,
			'update' => $update,
			'delete' => $delete
		]);
	}

	public function getUserByEmail($conection,$email)
	{
		$result = $conection->select('CALL RD_LoginUser(:email_user)',['email_user' => $email]);
		if (count($result)==0) {
			throw new \Exception('User : ' . $email.' '.Constant::MSG_NOT_FOUND, Constant::NOT_FOUND);
        }else{
            $contact_id = $result[0]->contact_id;
        }

            $result[0]->contact_id = $this->selectContacsbyUser($conection,$contact_id)[0];

		return $result;
	}

	public function selectContacsbyUser($conection,$id)
    {
       $result = $conection->select('SELECT * FROM contacts WHERE id = :id',['id'=>$id]);
       if(empty($result)){
        $result = [0=>[]];
       }
        return $result ;
    }


	public function selectRolsforSelect($conection)
    {
        return $conection->select('SELECT id, name FROM rols ORDER BY rol_name, id;');
    }

}
