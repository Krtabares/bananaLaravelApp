<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
        	'rol_name' => 'Super admin',
        	'description' => 'All access',
        	'all_access_column' => 1
        ]);

        Rol::create([
            'rol_name' => 'Secretary',
            'description' => 'Only view'
        ]);
    }
}
