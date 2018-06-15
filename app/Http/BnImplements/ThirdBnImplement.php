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

    public function comboSelect($conection)
    {
        $org_list = $conection->select('SELECT id, organization_name
			FROM organizations
			ORDER BY organization_name ASC');

        $language_list = $conection->select('SELECT id, languagescol
			FROM languages
			ORDER BY languagescol ASC');

        return [
        	'organizations' => $org_list, 
        	'languages' => $language_list
        ];
    }

    public function selectThirdById($conection, $third_id)
    {
    	$third = $conection->select('SELECT * FROM bpartners
        	WHERE id = :third_id', [
        	'third_id' => $third_id
        ]);

        return ['third' => $third];
    }

    public function insertThird($conection, $org_id, $logo, $customer, $vendor,
    	$name, $name_2, $employee, $prospect, $sales_rep, $reference_no,
    	$sales_rep_id, $credit_status, $credit_limit, $tax_id, $tax_exempt,
    	$pot_tax_exempt, $url, $description, $summary,
    	$price_list_id, $delivery_rule, $delivery_via_rule, $flat_discount,
    	$manufacturer, $po_price_list_id, $language_id, $greeting_id)
    {

    	$conection->select('CALL CR_InsertBpartners(:org_id, :logo, :customer, 
    		:vendor, :name, :name_2, :employee, :prospect, :sales_rep,
    		:reference_no, :sales_rep_id, :credit_status, :credit_limit,
    		:tax_id, :tax_exempt, :pot_tax_exempt, :url, :description, :summary,
    		:price_list_id, :delivery_rule, :delivery_via_rule, :flat_discount,
    		:manufacturer, :po_price_list_id, :language_id, :greeting_id)', [
    			'org_id' => $org_id,
    			'logo' => $logo,
    			'customer' => $customer,
    			'vendor' => $vendor,
		    	'name' => $name,
		    	'name_2' => $name_2,
		    	'employee' => $employee,
		    	'prospect' => $prospect,
		    	'sales_rep' => $sales_rep,
		    	'reference_no' => $reference_no,
		    	'sales_rep_id' => $sales_rep_id,
		    	'credit_status' => $credit_status,
		    	'credit_limit' => $credit_limit,
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

    public function updateThird($conection, $third_id, $org_id, $logo, $customer, $vendor,
    	$name, $name_2, $employee, $prospect, $sales_rep, $reference_no,
    	$sales_rep_id, $credit_status, $credit_limit, $tax_id, $tax_exempt,
    	$pot_tax_exempt, $url, $description, $summary,
    	$price_list_id, $delivery_rule, $delivery_via_rule, $flat_discount,
    	$manufacturer, $po_price_list_id, $language_id, $greeting_id)
    {

    	$conection->select('CALL UP_UpdateBpartners(:third_id, :org_id, :logo, :customer, 
    		:vendor, :name, :name_2, :employee, :prospect, :sales_rep,
    		:reference_no, :sales_rep_id, :credit_status, :credit_limit,
    		:tax_id, :tax_exempt, :pot_tax_exempt, :url, :description, :summary,
    		:price_list_id, :delivery_rule, :delivery_via_rule, :flat_discount,
    		:manufacturer, :po_price_list_id, :language_id, :greeting_id)', [
    			'third_id' => $third_id,
    			'org_id' => $org_id,
    			'logo' => $logo,
    			'customer' => $customer,
    			'vendor' => $vendor,
		    	'name' => $name,
		    	'name_2' => $name_2,
		    	'employee' => $employee,
		    	'prospect' => $prospect,
		    	'sales_rep' => $sales_rep,
		    	'reference_no' => $reference_no,
		    	'sales_rep_id' => $sales_rep_id,
		    	'credit_status' => $credit_status,
		    	'credit_limit' => $credit_limit,
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

    	$third_udpate = $conection->select('SELECT * FROM bpartners WHERE id = :third_id', [
    		'third_id' => $third_id
    	]);

    	return $third_udpate[0];
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