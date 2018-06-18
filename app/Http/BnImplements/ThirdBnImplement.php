<?php
namespace App\Http\BnImplements;

use App\Constant;
use Illuminate\Support\Facades\DB;
use App\Http\BnImplements\LocationBnImplement;

class ThirdBnImplement
{
    private $location_implement;

    function __construct(LocationBnImplement $location_implement)
    {
        $this->location_implement = $location_implement;
    }



	public function selectThirds($conection)
    {
        return $conection->select('SELECT * FROM bpartners
        	ORDER BY updated_at DESC, logo DESC');
    }

    public function selectFilterThirds($conection, $search)
    {
        return $conection->select('CALL RD_SelectFilteredThirds(:search)', ['search' => $search]);
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
    	$manufacturer, $po_price_list_id, $language_id, $greeting_id, $third_location)
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

        $location_insert = $this->location_implement
            ->insertLocation(
                $conection, $third_location['address_1'], 
                $third_location['address_2'], $third_location['address_3'],
                $third_location['address_4'], $third_location['city_id'],
                $third_location['city_name'], $third_location['postal'],
                $third_location['postal_add'], $third_location['state_id'],
                $third_location['state_name'], $third_location['country_id'],
                $third_location['comments']
            );

        $branch_office_insert = $this->insertBranchOffice($conection, $third_insert->id, $location_insert->id, 
            'Principal Branch Office', 1, 1, 1, 1, '', '', '', '');

    	return [
            'third' => $third_insert,
            'location' => $location_insert,
            'branch_office' => $branch_office_insert
        ];
    }

    public function updateThird($conection, $third_id, $org_id, $logo, $customer, $vendor,
    	$name, $name_2, $employee, $prospect, $sales_rep, $reference_no,
    	$sales_rep_id, $credit_status, $credit_limit, $tax_id, $tax_exempt,
    	$pot_tax_exempt, $url, $description, $summary,
    	$price_list_id, $delivery_rule, $delivery_via_rule, $flat_discount,
    	$manufacturer, $po_price_list_id, $language_id, $greeting_id, $third_location)
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

        

    	//return $third_udpate[0];
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

    public function insertBranchOffice($conection, $third_id, $location_id, 
        $name, $is_ship_to, $is_bill_to, $is_pay_from, $is_remit_to, $phone,
        $phone_2, $fax, $isdn)
    {
        $conection->select('CALL CR_InsertBranchOffice(:third_id, :location_id, 
            :name, :is_ship_to, :is_bill_to, :is_pay_from, :is_remit_to, :phone,
            :phone_2, :fax, :isdn)', [
            'third_id' => $third_id,
            'location_id' => $location_id,
            'name' => $name,
            'is_ship_to' => $is_ship_to,
            'is_bill_to' => $is_bill_to,
            'is_pay_from' => $is_pay_from,
            'is_remit_to' => $is_remit_to,
            'phone' => $phone,
            'phone_2' => $phone_2,
            'fax' => $fax,
            'isdn' => $isdn
        ]);

        $branch_insert = $conection->select('SELECT * FROM bpartners_locations ORDER BY id DESC LIMIT 1');

        return $branch_insert[0];
    }

    // public function insertLocationThird(
    //     /*parametros de location*/
    //     $conection, $third_location,
    //     /*parametros de bpartner_location*/ 
    //     $name, $is_ship_to, $is_bill_to, $is_pay_from, $is_remit_to, $phone,
    //     $phone_2, $fax, $isdn
    // )
    // {
    //     $location_insert = $this->location_implement
    //         ->insertLocation(
    //             $conection, $third_location['address_1'], 
    //             $third_location['address_2'], $third_location['address_3'],
    //             $third_location['address_4'], $third_location['city_id'],
    //             $third_location['city_name'], $third_location['postal'],
    //             $third_location['postal_add'], $third_location['state_id'],
    //             $third_location['state_name'], $third_location['country_id'],
    //             $third_location['comments']
    //         );

    //     $branch_insert = $this->insertBranchOffice($conection, $third_id, $location_insert->id, 
    //         $name, $is_ship_to, $is_bill_to, $is_pay_from, $is_remit_to, $phone,
    //         $phone_2, $fax, $isdn);

    //     return ['branch_office' => $branch_insert];
    // }
}