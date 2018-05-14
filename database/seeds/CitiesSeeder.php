<?php

use App\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
        	'state_id' => 1,
        	'city' => 'caracas',
        	'capital' => true
        ]);

        City::create([
        	'state_id' => 2,
        	'city' => 'barranquilla',
        	'capital' => false
        ]);

        City::create([
        	'state_id' => 3,
        	'city' => 'cusco',
        	'capital' => false
        ]);
    }
}
