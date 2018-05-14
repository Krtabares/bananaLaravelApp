<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->truncateTables([
            'clients',
            'organizations',
            'rols',
            'users',
            'users_organizations',
            'tables',
            'columns',
    		'countries',
    		'cities',
    		'states',
            'payment_terms',
            'term_types',
            'units',
            'categories'
    	]);

        // $this->call(UsersTableSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(OrganizationsSeeder::class);
        $this->call(RolsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(UsersOrganizationsSeeder::class);
        $this->call(TablesSeeder::class);
        $this->call(ColumnsSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(StatesSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(PaymentTermsSeeder::class);
        $this->call(TermTypesSeeder::class);
        $this->call(UnitsSeeder::class);
        $this->call(CategoriesSeeder::class);
    }

    protected function truncateTables(array $tables){

    	DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

    	foreach ($tables as $table) {
    		
    		DB::table($table)->truncate();

    	}

    	DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    }
}
