<?php

namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class BananaMigrationsBnImplement
{

	public function selectColumnsClients($conection)
    {
        return $conection->select("SELECT t1.id id_column, t1.column_name, t2.table_name , (if(t3.required is null,0, t3.required)) as required, 0 as selected  from columns t1
                left join tables t2 ON t1.table_id = t2.id
                left join field_configurations t3 ON t1.id = t3.column_id
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

    public function preprareQueryMigration($guideMigration)
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

                $querys[$key] = " INSERT INTO " . $key . " ( " .$strColumns[$key]. " ) VALUES ( ". $strMigrationColumnsName[$key] ." ) ";
            }

           dd($querys);

        }


    }

}
