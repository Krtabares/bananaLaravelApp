<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
        	'client_name' => 'Overcom',
        	'description' => 'caracas',
        	'language' => 'spa'
        ]);
    }
}
