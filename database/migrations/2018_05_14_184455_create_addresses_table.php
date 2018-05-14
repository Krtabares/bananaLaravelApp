<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address_1', 60)->nullable();
            $table->string('address_2', 60)->nullable();
            $table->string('address_3', 60)->nullable();
            $table->string('address_4', 60)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('postal_add', 10)->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->string('city', 45)->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->string('state', 45)->nullable();
            $table->unsignedInteger('country_id')->nullable();

            $table->unsignedInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organizations');

            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('addresses');
    }
}
