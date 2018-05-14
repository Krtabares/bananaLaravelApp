<?php

use App\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create([
        	'country_id' => 1,
        	'state' => 'miranda',
        	'iso' => 'mir'
        ]);

        State::create([
        	'country_id' => 2,
        	'state' => 'bogota',
        	'iso' => 'bog'
        ]);

        State::create([
        	'country_id' => 3,
        	'state' => 'lima',
        	'iso' => 'lim'
        ]);
    }
}
