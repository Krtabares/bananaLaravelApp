<?php

use Illuminate\Database\Seeder;
use App\Organization;

class OrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::create([
        	'client_id' => 1,
        	'organization_name' => 'Overcom',
        ]);
    }
}
