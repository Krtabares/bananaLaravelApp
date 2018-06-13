<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;

class ThirdBnImplement
{
	public function selectThirds($conection)
    {
        return $conection->select('SELECT * FROM bpartners
        	ORDER BY updated_at DESC, logo DESC');
    }

    public function insertThird($conection, $org_id, $logo, $customer, $vendor,
    	$third_name, $third_name_2, $employee, $prospect, $sales_rep, $reference_no,
    	$sales_rep_id, $credit_status, $credit_limit, $total_open_balance,
    	$tax_id, $tax_exempt, $pot_tax_exempt, $url, $description, $summary,
    	$price_list_id, $delivery_rule, $delivery_via_rule, $flat_discount,
    	$manufacturer, $po_price_list_id, $language_id, $greeting_id)
    {

    	$conection->select('CALL CR_InsertBpartners(:org_id, :logo, :customer, 
    		:vendor, :third_name, :third_name_2, :employee, :prospect, :sales_rep,
    		:reference_no, :sales_rep_id, :credit_status, :credit_limit, :total_open_balance,
    		:tax_id, :tax_exempt, :pot_tax_exempt, :url, :description, :summary,
    		:price_list_id, :delivery_rule, :delivery_via_rule, :flat_discount,
    		:manufacturer, :po_price_list_id, :language_id, :greeting_id)', [
    			'org_id' => $org_id,
    			'logo' => $logo,
    			'customer' => $customer,
    			'vendor' => $vendor,
		    	'third_name' => $third_name,
		    	'third_name_2' => $third_name_2,
		    	'employee' => $employee,
		    	'prospect' => $prospect,
		    	'sales_rep' => $sales_rep,
		    	'reference_no' => $reference_no,
		    	'sales_rep_id' => $sales_rep_id,
		    	'credit_status' => $credit_status,
		    	'credit_limit' => $credit_limit,
		    	'total_open_balance' => $total_open_balance,
		    	'tax_id' => $tax_id,
		    	'tax_exempt' => $tax_exempt,
		    	'pot_tax_exempt' => $pot_tax_exempt,
		    	'url' => $url,
		    	'description' => $description,
		    	'summary' => $summary,
		    	'price_list_id' => $price_list_id,
		    	'delivery_rule' => $delivery_rule,
		    	'delivery_via_rule' => $delivery_via_rule,
		    	'flat_discount' => $flat_discount,
		    	'manufacturer' => $manufacturer,
		    	'po_price_list_id' => $po_price_list_id,
		    	'language_id' => $language_id,
		    	'greeting_id' => $greeting_id
    		]);

    	$third_insert = $conection->select('SELECT * FROM bpartners ORDER BY id DESC LIMIT 1');

    	return $third_insert[0];
    }

    public function archivedThird($conection, $third_id, $archived)
	{
		$conection->select('CALL DL_ArchivedThird(:third_id, :archived)', [
			'third_id' => $third_id,
			'archived' => $archived
		]);

		return $conection->select('SELECT * FROM bpartners
			WHERE id = :third_id', [
				'third_id' => $third_id
			]);
	}
}