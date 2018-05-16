<?php

use Illuminate\Database\Seeder;
use App\Rol;
//use Illuminate\Support\Facades\DB;

class PermissionsRolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = Rol::findOrfail(2)
            ->columns()
            ->attach([
                1 => ['read' => 1],
                2 => ['read' => 1],
                3 => ['read' => 1],
                4 => ['read' => 1],
                5 => ['read' => 1],
                6 => ['read' => 1],
                7 => ['read' => 1],
                8 => ['read' => 1]
            ]);

        /*
        $rol = Rol::findOrfail(2)
            ->columns()
            ->attach(2,[
                'read' => 1
            ]);

        $rol = Rol::findOrfail(2)
            ->columns()
            ->attach(3,[
                'read' => 1
            ]);

        $rol = Rol::findOrfail(2)
            ->columns()
            ->attach(4,[
                'read' => 1
            ]);

        $rol = Rol::findOrfail(2)
            ->columns()
            ->attach(5,[
                'read' => 1
            ]);

        $rol = Rol::findOrfail(2)
            ->columns()
            ->attach(6,[
                'read' => 1
            ]);

        $rol = Rol::findOrfail(2)
            ->columns()
            ->attach(7,[
                'read' => 1
            ]);

        $rol = Rol::findOrfail(2)
            ->columns()
            ->attach(8,[
                'read' => 1
            ]);
        */
    }
}
