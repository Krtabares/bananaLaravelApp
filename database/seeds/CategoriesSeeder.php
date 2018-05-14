<?php

use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
        	'tag' => 'hogar',
        	'color' => 'azul'
        ]);

        Category::create([
            'tag' => 'cocina',
            'parent_id' => 1,
            'color' => 'blanco'
        ]);

        Category::create([
            'tag' => 'sala',
            'parent_id' => 1,
            'color' => 'naranja'
        ]);
    }
}
