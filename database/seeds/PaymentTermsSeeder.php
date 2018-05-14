<?php

use App\PaymentTerm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentTerm::create([
        	'name' => 'balance 30D',
            'notes' => 'Pago total de la factura en 30 dias'
        ]);

        PaymentTerm::create([
        	'name' => '50-50 30-60D',
            'notes' => '50 por ciento 30 dias 50 por ciento 60 dias'
        ]);

        PaymentTerm::create([
        	'name' => 'Monto fijo 100M 30D',
            'notes' => 'Pago de 100 millones en 30 dias'
        ]);
    }
}
