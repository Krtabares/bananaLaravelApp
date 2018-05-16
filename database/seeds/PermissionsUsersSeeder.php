<?php

use Illuminate\Database\Seeder;
use App\User;
//use Illuminate\Support\Facades\DB;

class PermissionsUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::findOrfail(2)
            ->columns()
            ->attach([
                1 => ['create' => 1],
                2 => ['create' => 1],
                3 => ['create' => 1],
                4 => ['create' => 1],
                5 => ['create' => 1],
                6 => ['create' => 1],
                7 => ['create' => 1],
                8 => ['create' => 1]
            ]);
    }
}
