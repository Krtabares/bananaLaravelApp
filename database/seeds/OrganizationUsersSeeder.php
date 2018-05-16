<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersOrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organization_user')
            ->insert([
                'user_id' => 1,
                'organization_id' => 1
            ]);

        DB::table('organization_user')
            ->insert([
                'user_id' => 2,
                'organization_id' => 1
            ]);
    }
}
