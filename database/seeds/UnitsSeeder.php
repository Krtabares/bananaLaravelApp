<?php

use App\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
        	'tag' => 'Byte',
        	'quantity' => 1
        ]);

        Unit::create([
        	'tag' => 'Kilobyte',
        	'quantity' => 1024
        ]);

        Unit::create([
        	'tag' => 'Megabyte',
        	'quantity' => 1048576
        ]);

        Unit::create([
        	'tag' => 'Gigabyte',
        	'quantity' => 1073741824
        ]);

        Unit::create([
        	'tag' => 'Terabyte',
        	'quantity' => 1099511627776
        ]);
    }
}
