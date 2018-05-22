<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrRols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE PROCEDURE CR_Rols ( IN bp_Rol_Name VARCHAR(45), bp_Description VARCHAR(45), bp_All_Access_Column BOOLEAN )
                BEGIN
                    INSERT INTO rols (rol_name, description, all_access_column) VALUES (bp_Rol_Name, bp_Description, bp_All_Access_Column);
                END'
            );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS CR_Rols');
    }
}
