<?php

use Illuminate\Database\Seeder;
use App\Column;

class ColumnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Columnas de clientes
        Column::create([
        	'table_id' => 1,
        	'column_name' => 'client_name',
        ]);
        Column::create([
        	'table_id' => 1,
        	'column_name' => 'description',
        ]);
        Column::create([
        	'table_id' => 1,
        	'column_name' => 'archived',
        ]);
        Column::create([
        	'table_id' => 1,
        	'column_name' => 'language',
        ]);

		//columnas de organizations
		Column::create([
        	'table_id' => 2,
        	'column_name' => 'client_id'
        ]);
        Column::create([
        	'table_id' => 2,
        	'column_name' => 'organization_name'
        ]);
        Column::create([
        	'table_id' => 2,
        	'column_name' => 'description'
        ]);
        Column::create([
        	'table_id' => 2,
        	'column_name' => 'archived'
        ]);

        //columnas de rols
		Column::create([
        	'table_id' => 3,
        	'column_name' => 'rol_name'
        ]);
        Column::create([
        	'table_id' => 3,
        	'column_name' => 'description'
        ]);
        Column::create([
        	'table_id' => 3,
        	'column_name' => 'all_access_column'
        ]);
        Column::create([
        	'table_id' => 3,
        	'column_name' => 'archived'
        ]);

        //columnas de users
		Column::create([
        	'table_id' => 4,
        	'column_name' => 'rol_id'
        ]);
        Column::create([
        	'table_id' => 4,
        	'column_name' => 'user_name'
        ]);
        Column::create([
        	'table_id' => 4,
        	'column_name' => 'email'
        ]);
        Column::create([
        	'table_id' => 4,
        	'column_name' => 'all_access_organization'
        ]);
        Column::create([
        	'table_id' => 4,
        	'column_name' => 'password'
        ]);
        Column::create([
        	'table_id' => 4,
        	'column_name' => 'archived'
        ]);

        //columnas de paises
        Column::create([
        	'table_id' => 5,
        	'column_name' => 'iso'
        ]);
        Column::create([
        	'table_id' => 5,
        	'column_name' => 'country'
        ]);
        Column::create([
        	'table_id' => 5,
        	'column_name' => 'archived'
        ]);

        //columnas de estados
        Column::create([
        	'table_id' => 6,
        	'column_name' => 'country_id'
        ]);
        Column::create([
        	'table_id' => 6,
        	'column_name' => 'state'
        ]);
        Column::create([
        	'table_id' => 6,
        	'column_name' => 'iso'
        ]);
        Column::create([
        	'table_id' => 6,
        	'column_name' => 'archived'
        ]);

        //columnas de ciudades
        Column::create([
        	'table_id' => 7,
        	'column_name' => 'state_id'
        ]);
        Column::create([
        	'table_id' => 7,
        	'column_name' => 'city'
        ]);
        Column::create([
        	'table_id' => 7,
        	'column_name' => 'capital'
        ]);
        Column::create([
        	'table_id' => 7,
        	'column_name' => 'archived'
        ]);

        //columnas de addresses
		Column::create([
        	'table_id' => 8,
        	'column_name' => 'address_1'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'address_2'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'address_3'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'address_4'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'city_id'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'city'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'zip'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'postal_add'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'state_id'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'state'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'country_id'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'organization_id'
        ]);
        Column::create([
        	'table_id' => 8,
        	'column_name' => 'client_id'
        ]);

        //columnas de permissions_users
		Column::create([
        	'table_id' => 9,
        	'column_name' => 'user_id'
        ]);
        Column::create([
        	'table_id' => 9,
        	'column_name' => 'column_id'
        ]);
        Column::create([
        	'table_id' => 9,
        	'column_name' => 'create'
        ]);
        Column::create([
        	'table_id' => 9,
        	'column_name' => 'read'
        ]);
        Column::create([
        	'table_id' => 9,
        	'column_name' => 'update'
        ]);Column::create([
        	'table_id' => 9,
        	'column_name' => 'delete'
        ]);

        //columnas de permissions_rols
		Column::create([
        	'table_id' => 10,
        	'column_name' => 'rol_id'
        ]);
        Column::create([
        	'table_id' => 10,
        	'column_name' => 'column_id'
        ]);
        Column::create([
        	'table_id' => 10,
        	'column_name' => 'create'
        ]);
        Column::create([
        	'table_id' => 10,
        	'column_name' => 'read'
        ]);
        Column::create([
        	'table_id' => 10,
        	'column_name' => 'update'
        ]);Column::create([
        	'table_id' => 10,
        	'column_name' => 'delete'
        ]);

        //columnas de units
		Column::create([
        	'table_id' => 11,
        	'column_name' => 'tag'
        ]);
        Column::create([
        	'table_id' => 11,
        	'column_name' => 'quantity'
        ]);
        Column::create([
        	'table_id' => 11,
        	'column_name' => 'archived'
        ]);

        //columnas de payment_terms
		Column::create([
        	'table_id' => 12,
        	'column_name' => 'name'
        ]);
        Column::create([
        	'table_id' => 12,
        	'column_name' => 'notes'
        ]);
        Column::create([
        	'table_id' => 12,
        	'column_name' => 'archived'
        ]);

        //columnas de term_types
		Column::create([
        	'table_id' => 13,
        	'column_name' => 'payment_terms_id'
        ]);
        Column::create([
        	'table_id' => 13,
        	'column_name' => 'type'
        ]);
        Column::create([
        	'table_id' => 13,
        	'column_name' => 'day'
        ]);
        Column::create([
        	'table_id' => 13,
        	'column_name' => 'typeid'
        ]);
        Column::create([
        	'table_id' => 13,
        	'column_name' => 'typeem'
        ]);
        Column::create([
        	'table_id' => 13,
        	'column_name' => 'typenm'
        ]);
        Column::create([
        	'table_id' => 13,
        	'column_name' => 'daydxpp'
        ]);
        Column::create([
        	'table_id' => 13,
        	'column_name' => 'percentdxpp'
        ]);
        Column::create([
        	'table_id' => 13,
        	'column_name' => 'fixed_amount'
        ]);
        Column::create([
        	'table_id' => 13,
        	'column_name' => 'percentage'
        ]);

        //columnas de categorias
		Column::create([
        	'table_id' => 14,
        	'column_name' => 'tag'
        ]);
        Column::create([
        	'table_id' => 14,
        	'column_name' => 'parent_id'
        ]);
        Column::create([
        	'table_id' => 14,
        	'column_name' => 'color'
        ]);Column::create([
        	'table_id' => 14,
        	'column_name' => 'archived'
        ]);
    }
}
