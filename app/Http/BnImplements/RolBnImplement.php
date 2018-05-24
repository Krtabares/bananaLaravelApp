<?php

namespace App\Http\BnImplements;

use Illuminate\Support\Facades\DB;

class RolBnImplement
{
    public function selectRol()
    {
        $rol = DB::select('CALL RD_Rols()');

        return $rol;
    }

    public function insertRol($rol_name, $description, $all_access_column)
    {
        try {

            DB::beginTransaction();

            DB::select('CALL CR_Rols(:rol_name, :description, :all_access_column)', [
                'rol_name' => $rol_name,
                'description' => $description,
                'all_access_column' => $all_access_column
            ]);

            /*
                insertar permisos
            */

        } catch (\Illuminate\Database\QueryException $e) {
            
            switch ( $e->errorInfo[1] ) {
                
                case Constant::DUPLICATE :
                    return response( Constant::MSG_DUPLICATE , Constant::NOT_IMPLEMENTED)
                        ->header('Content-Type', 'application/json');
                break;

                case Constant::TOO_LONG :
                    return response( Constant::MSG_TOO_LONG , Constant::NOT_IMPLEMENTED)
                        ->header('Content-Type', 'application/json');
                break;

                default:
                    return response( Constant::MSG_ERROR_DB , Constant::NOT_IMPLEMENTED)
                        ->header('Content-Type', 'application/json'); 
                break;
            }

            DB::rollBack();

        } catch (Exception $e) {
        
            return response($e->getMessage(), Constant::INTERNAL_SERVER_ERROR);

            DB::rollBack();
        
        }

        return response( Constant::MSG_SUCCESS , Constant::OK)->header('Content-Type', 'application/json');
    }
}
