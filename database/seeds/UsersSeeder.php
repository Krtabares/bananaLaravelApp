<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'rol_id' => 1,
        	'user_name' => 'super_user',
        	'email' => 'super_user@admin.com',
        	'password' => bcrypt('super_user'),
        	'all_access_organization' => 1,
            'all_access_column' => 1
        ]);

        User::create([
            'rol_id' => 2,
            'user_name' => 'secretary',
            'email' => 'secretary@overcom.com',
            'password' => bcrypt('123456')
        ]);
    }
}
