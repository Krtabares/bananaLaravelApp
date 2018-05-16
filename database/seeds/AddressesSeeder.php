<?php

use Illuminate\Database\Seeder;
use App\Address;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
        	'address_1' => 'boleita norte',
        	'city_id' => 1,
        	'state_id' => 1,
        	'country_id' => 1,
        	'client_id' => 1
        ]);
    }
}
