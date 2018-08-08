<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class BananaMigrationsBnImplement
{

	public function selectColumnsClients($conection)
    {
        return $conection->select("SELECT t1.id id_column, t1.column_name, t2.table_name , (if(t3.required is null,0, t3.required)) as required, t4.name as type_data,  0 as selected  from columns t1
        left join tables t2 ON t1.table_id = t2.id
        left join field_configurations t3 ON t1.id = t3.column_id
        left join column_type t4 on t1.column_type_id = t4.id
        where (table_id = 17 or table_id = 21)  and t1.column_name not like 'organization_id' and t1.column_name not like 'updated_at'");
    }

    // public function spMigration(
    //     $conection,
	// 	$org_id,
	// 	$logo,
	// 	$customer,
	// 	$vendor,
	// 	$name,
	// 	$name_2,
	// 	$employee,
	// 	$prospect,
	// 	$sales_rep,
	// 	$reference_no,
	// 	$sales_rep_id,
	// 	$credit_status,
	// 	$credit_limit,
	// 	$tax_id,
	// 	$tax_exempt,
	// 	$pot_tax_exempt,
	// 	$url,
	// 	$description,
	// 	$summary,
	// 	$price_list_id,
	// 	$delivery_rule,
	// 	$delivery_via_rule,
	// 	$flat_discount,
	// 	$manufacturer,
	// 	$po_price_list_id,
	// 	$language_id,
	// 	$greeting_id,
	// 	$third_location,
    //     $branch_office,
    //     $address_1,
    //     $address_2,
    //     $address_3,
    //     $address_4,
    //     $city_id,
    //     $city_name,
    //     $postal,
    //     $postal_add,
    //     $state_id,
    //     $state_name,
    //     $country_id,
    //     $comments
    // )
    // {

    //  $conection->select('CALL migrateBpartner(
    //         :org_id,
    //         :logo,
    //         :customer,
    //         :vendor,
    //         :name,
    //         :name_2,
    //         :employee,
    //         :prospect,
    //         :sales_rep,
    //         :reference_no,
    //         :sales_rep_id,
    //         :credit_status,
    //         :credit_limit,
    //         :tax_id,
    //         :tax_exempt,
    //         :pot_tax_exempt,
    //         :url,
    //         :description,
    //         :summary,
    //         :price_list_id,
    //         :delivery_rule,
    //         :delivery_via_rule,
    //         :flat_discount,
    //         :manufacturer,
    //         :po_price_list_id,
    //         :language_id,
    //         :greeting_id,
    //         :address_1,
    //         :address_2,
    //         :address_3,
    //         :address_4,
    //         :city_id,
    //         :city_name,
    //         :postal,
    //         :postal_add,
    //         :state_id,
    //         :state_name,
    //         :country_id,
    //         :comment
    //     )', [
    //             'org_id' => $org_id,
    //             'logo' => $logo,
    //             'customer' => $customer,
    //             'vendor' => $vendor,
    //             'name' => $name,
    //             'name_2' => $name_2,
    //             'employee' => $employee,
    //             'prospect' => $prospect,
    //             'sales_rep' => $sales_rep,
    //             'reference_no' => $reference_no,
    //             'sales_rep_id' => $sales_rep_id,
    //             'credit_status' => $credit_status,
    //             'credit_limit' => $credit_limit,
    //             'tax_id' => $tax_id,
    //             'tax_exempt' => $tax_exempt,
    //             'pot_tax_exempt' => $pot_tax_exempt,
    //             'url' => $url,
    //             'description' => $description,
    //             'summary' => $summary,
    //             'price_list_id' => $price_list_id,
    //             'delivery_rule' => $delivery_rule,
    //             'delivery_via_rule' => $delivery_via_rule,
    //             'flat_discount' => $flat_discount,
    //             'manufacturer' => $manufacturer,
    //             'po_price_list_id' => $po_price_list_id,
    //             'language_id' => $language_id,
    //             'greeting_id' => $greeting_id,
    //             'address_1' => $address_1,
    //             'address_2' => $address_2,
    //             'address_3' => $address_3,
    //             'address_4' => $address_4,
    //             'city_id' => $city_id,
    //             'city_name' => $city_name,
    //             'postal' => $postal,
    //             'postal_add' => $postal_add,
    //             'state_id' => $state_id,
    //             'state_name' => $state_name,
    //             'country_id' => $country_id,
    //             'comments' => $comments
    //         ]
    //     );

    // }

    public function preprareQueryInsertMigration($guideMigration)
    {

        if (!is_array($guideMigration)) {
            throw new \Exception("error in guide migration", Constant::BAD_REQUEST);
        }else{

            $tablesAndColumns = [];
            $migrationColumnsName=[];
            $columnsBD = [];
            $querys = [];
            $strColumns = [];
            $strMigrationColumnsName = [];


            foreach ($guideMigration as $key => $obj) {
                // verifica si la columna llega vacia
                if (!is_null($obj['column'])) {

                    $is_add=false;
                    //recorre tablas para saber si la tabla de l columna ya existe
                    foreach ($tablesAndColumns as $key => $value) {

                        if($obj['column']['table_name'] == $key ){
                                $is_add = true;
                                 break;
                        }
                    }
                    //si no existe la agrega
                    if (!$is_add) {
                        $tablesAndColumns[$obj['column']['table_name']] = [];
                    }

                    $tablesAndColumns[$obj['column']['table_name']][] = $obj['column']['column_name'];
                    $migrationColumnsName[$obj['column']['table_name']][] = ':'.$obj['columnName'];

                }

            } //end foreach


            foreach ($tablesAndColumns as $key => $value)
                $strColumns[$key] = implode(' , ', $value);

            foreach ($migrationColumnsName as $key => $value)
                $strMigrationColumnsName[$key] = implode(' , ', $value);

            foreach ($tablesAndColumns as $key => $value) {

                $querys[$key] = "  INSERT INTO " . $key . "_tmp ( " .$strColumns[$key]. " ) VALUES ";
            }

           return $querys;

        }


    }

    public function preprareQueryUpdateMigration($guideMigration)
    {

        if (!is_array($guideMigration)) {
            throw new \Exception("error in guide migration", Constant::BAD_REQUEST);
        }else{

            $tablesAndColumns = [];
            $migrationColumnsName=[];
            $columnsBD = [];
            $querys = [];
            $strColumns = [];
            $strMigrationColumnsName = [];


            foreach ($guideMigration as $key => $obj) {
                // verifica si la columna llega vacia
                if (!is_null($obj['column'])) {

                    $is_add=false;
                    //recorre tablas para saber si la tabla de l columna ya existe
                    foreach ($tablesAndColumns as $key => $value) {

                        if($obj['column']['table_name'] == $key ){
                                $is_add = true;
                                 break;
                        }
                    }
                    //si no existe la agrega
                    if (!$is_add) {
                        $tablesAndColumns[$obj['column']['table_name']] = [];
                    }

                    $tablesAndColumns[$obj['column']['table_name']][] = $obj['column']['column_name'];
                    $migrationColumnsName[$obj['column']['table_name']][] = ':'.$obj['columnName'];

                }

            } //end foreach

            $singleQuery = "  UPDATE ";

            dd($tablesAndColumns, $migrationColumnsName);

            foreach ($tablesAndColumns as $key => $arrayColums) {
                foreach ($arrayColums as $key => $value) {
                    # code...
                }
            }

            // foreach ($tablesAndColumns as $key => $value)
            //     $strColumns[$key] = implode(' , ', $value);

            // foreach ($migrationColumnsName as $key => $value)
            //     $strMigrationColumnsName[$key] = implode(' , ', $value);

            // foreach ($tablesAndColumns as $key => $value) {

            //     $querys[$key] = " INSERT INTO " . $key . " ( " .$strColumns[$key]. " ) VALUES ( ". $strMigrationColumnsName[$key] ." ) ";
            // }

           dd($querys);

        }


    }

    public function migrate($conection,$guideMigration , $jsonimport)
    {

        // if (!is_array($jsonimport)) {
        //     throw new \Exception("error in guide migration", Constant::BAD_REQUEST);
        // }else{

            $querys = $this->preprareQueryInsertMigration($guideMigration);
            $statemensQuerys = [];
            $i = 0;

            error_log("inicio");
            foreach ($jsonimport as $key => $registro) {

                $valueQuery = "";
                 $arrayattr = [];

                foreach ($querys as $keyquery => $value) {// recorre los querys disponibles

                    $arrayattr = [];

                     foreach ($guideMigration as $keyGuide => $valueGuide) {// ferifica si el atributo exixte en el arreglo si no lo agrega

                            if(!array_key_exists($keyGuide,$registro)){
                                $attr = null;
                                switch ($valueGuide['column']['type_data']) {
                                    case 'String':
                                            $attr = ""  ;
                                        break;
                                    case 'Boolean':
                                            $attr =  0 ;
                                        break;
                                    case 'Number':
                                        $attr =  0 ;
                                    break;
                                }

                                $registro[$keyGuide] = $attr;
                            }
                        }

                    foreach ($registro as $key => $attr) {


                        if($guideMigration[$key]['column'] != null && $guideMigration[$key]['column']['table_name'] == $keyquery ){

                            switch ($guideMigration[$key]['column']['type_data']) {
                                case 'String':
                                        $attr = $this->sanear_string($attr);
                                        $attr =  $conection->getPdo()->quote($attr)  ;
                                    break;
                                case 'Boolean':
                                        $attr =  ( strtoupper($attr)  == 'TRUE' || strtoupper($attr) == "T" || $attr == '1' )? 1 : 0 ;
                                    break;

                            }

                            $arrayattr[] = $attr;
                        }


                    }

                    $valueQuery = " ( ".implode(" , ",$arrayattr)." ) ";
                    $statemensQuerys[$keyquery][] = $valueQuery;
                    if($i< 1000)
                        error_log($i." " . $valueQuery);
                    $i = $i + 1;
                }

            }
            error_log("final");

            foreach ($querys as $key => $value) {
                $conection->select("TRUNCATE `banana`.". $key ."_tmp;");
                $conection->select($value . implode(" , ", $statemensQuerys[$key]));

            }

            // dd($guideMigration,$jsonimport, $querys,  $statemensQuerys );


        // }
    }

    /**
 * Reemplaza todos los acentos por sus equivalentes sin ellos
 *
 * @param $string
 *  string la cadena a sanear
 *
 * @return $string
 *  string saneada
 */
function sanear_string($string)
{

    $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\n", "¨", "º","°", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "<code>", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ","
            //  ,
            //  ":",
            //  ".",
            //  " "
            ),
        '',
        $string
    );


    return $string;
}

}
