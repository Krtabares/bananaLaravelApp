<?php

use Illuminate\Database\Seeder;
use App\Table;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        Table::create([
        	'table_name' => 'clients',
        	'description' => 'Table clients'
        ]);

        //2
        Table::create([
        	'table_name' => 'organizations',
        	'description' => 'Table organizations'
        ]);

        //3
        Table::create([
        	'table_name' => 'rols',
        	'description' => 'Table rols'
        ]);

        //4
        Table::create([
        	'table_name' => 'users',
        	'description' => 'Table users'
        ]);

        //5
        Table::create([
            'table_name' => 'countries',
            'description' => 'Table countries'
        ]);

        //6
        Table::create([
            'table_name' => 'states',
            'description' => 'Table states'
        ]);

        //7
        Table::create([
            'table_name' => 'cities',
            'description' => 'Table cities'
        ]);

        //8
        Table::create([
            'table_name' => 'addresses',
            'description' => 'Table addresses'
        ]);

        //9
        Table::create([
            'table_name' => 'permissions_users',
            'description' => 'Table permissions_users'
        ]);

        //10
        Table::create([
            'table_name' => 'permissions_rols',
            'description' => 'Table permissions_rols'
        ]);

        //11
        Table::create([
            'table_name' => 'units',
            'description' => 'Table units'
        ]);

        //12
        Table::create([
            'table_name' => 'payment_terms',
            'description' => 'Table payment_terms'
        ]);

        //13
        Table::create([
            'table_name' => 'term_types',
            'description' => 'Table term_types'
        ]);

        //14
        Table::create([
            'table_name' => 'categories',
            'description' => 'Table categories'
        ]);
    }
}
