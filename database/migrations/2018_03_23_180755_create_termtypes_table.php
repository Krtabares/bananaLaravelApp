<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_types', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('payment_terms_id');
            $table->foreign('payment_terms_id')->references('id')->on('payment_terms');
            /*
                Tipo de termino:

                B = Balance (saldo de la factura)
                P = Percentage (porcentaje especifico)
                M = Fixed Mount (un monto fijo)
            */
            $table->char('type', 1);
            /*
                Dias para el vencimiento
            */
            $table->unsignedInteger('day')->nullable();
            /*
                Type Invoice Date - significa vencimiento fecha factura
            */
            $table->boolean('typeid')->default(0);
            /*
                Last day of current month - Vencimiento el ultimo del mes de la factura
            */
            $table->boolean('typeem')->default(0);
            /*
                Last day of next month - Venciemiento el ultimo del mes del mes siguiente la factura
            */
            $table->boolean('typenm')->default(0);
            /*
                dia de descuento pronto pago
            */
            $table->unsignedInteger('daydxpp')->nullable();
            /*
                porcentaje de descuento pronto pago
            */
            $table->double('percentdxpp', 5, 2)->nullable();

            $table->double('fixed_amount', 15, 2)->nullable();
            $table->double('percentage', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term_types');
    }
}
