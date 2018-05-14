<?php

use App\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

        Country::create([
        	'iso' => 'co',
        	'country' => 'colombia'
        ]);

        Country::create([
        	'iso' => 'pe',
        	'country' => 'peru'
        ]);
    }
}
