<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\FilesUtils;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\ThirdBnImplement;
use App\Http\BnImplements\ContactBnImplement;
use Illuminate\Support\Facades\Storage;


class ThirdsController extends Controller
{
	private $third_implement;
	private $contact_implement;

	function __construct(
		ThirdBnImplement $third_implement,
		ContactBnImplement $contact_implement
	)
	{
		$this->third_implement = $third_implement;
		$this->contact_implement = $contact_implement;
	}

	public function indexThird(Request $request)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));
			
			if ( !$request->filled('type_third') )
				throw new \Exception("Type third is required", Constant::BAD_REQUEST);

			$thirds = $this->third_implement->selectThirds($conection, $request->type_third);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(json_encode(['thirds' => $thirds]), Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function selectThirdById(Request $request, $id)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$third = $this->third_implement->selectThirdById($conection, $id);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response($third, Constant::OK)->header('Content-Type', 'application/json');
	}

	public function indexFilterThird(Request $request)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			 $conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			if ( $request->filled('filter') ) {

				$filter_thirds = $this->third_implement->selectFilterThirds(
					$conection, $request->filter
				);

			} else
				throw new \Exception("Filter is required", Constant::BAD_REQUEST);


		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(json_encode(['filter_thirds' => $filter_thirds]), Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function comboSelect(Request $request)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$combo_select = $this->third_implement->comboSelect($conection);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(json_encode($combo_select), Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function storeThird(Request $request)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

			if ( !$request->filled('organization_id') )
				throw new \Exception("Organization is required", Constant::BAD_REQUEST);

			if ( !$request->filled('reference_no') )
				throw new \Exception("Reference number is required", Constant::BAD_REQUEST);

			if ( !$request->filled('name') )
				throw new \Exception("Third name is required", Constant::BAD_REQUEST);

			if ( !$request->filled('third_location') )
				throw new \Exception("Third Location is required", Constant::BAD_REQUEST);

			if ( $request->third_location['address_1'] == NULL )
				throw new \Exception("Indicate at least one address", Constant::BAD_REQUEST);

			/*
				if ( !$request->filled('logo') )
					throw new \Exception("Logo is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_customer') )
					throw new \Exception("Customer is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_vendor') )
					throw new \Exception("Vendor is required", Constant::BAD_REQUEST);

				if ( !$request->filled('name_2') )
					throw new \Exception("Third name 2 is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_employee') )
					throw new \Exception("Employee is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_prospect') )
					throw new \Exception("Prospect is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_sales_rep') )
					throw new \Exception("Sales rep is required", Constant::BAD_REQUEST);

				if ( !$request->filled('sales_rep_id') )
					throw new \Exception("Sales rep id is required", Constant::BAD_REQUEST);

				if ( !$request->filled('credit_status') )
					throw new \Exception("Credit status is required", Constant::BAD_REQUEST);

				if ( !$request->filled('credit_limit') )
					throw new \Exception("Credit limit is required", Constant::BAD_REQUEST);

				if ( !$request->filled('tax_id') )
					throw new \Exception("Tax id is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_tax_exempt') )
					throw new \Exception("Tax exempt is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_po_tax_exempt') )
					throw new \Exception("Pot ax exempt is required", Constant::BAD_REQUEST);

				if ( !$request->filled('url') )
					throw new \Exception("Url is required", Constant::BAD_REQUEST);

				if ( !$request->filled('description') )
					throw new \Exception("Description is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_summary') )
					throw new \Exception("Summary is required", Constant::BAD_REQUEST);

				if ( !$request->filled('price_list_id') )
					throw new \Exception("Price list id is required", Constant::BAD_REQUEST);

				if ( !$request->filled('delivery_rule') )
					throw new \Exception("Delivery rule is required", Constant::BAD_REQUEST);

				if ( !$request->filled('delivery_via_rule') )
					throw new \Exception("Delivery via rule is required", Constant::BAD_REQUEST);

				if ( !$request->filled('flat_discount') )
					throw new \Exception("Flat discount is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_manufacturer') )
					throw new \Exception("Manufacturer is required", Constant::BAD_REQUEST);

				if ( !$request->filled('po_price_list_id') )
					throw new \Exception("Po price list id is required", Constant::BAD_REQUEST);

				if ( !$request->filled('language_id') )
					throw new \Exception("Language id is required", Constant::BAD_REQUEST);

				if ( !$request->filled('greeting_id') )
					throw new \Exception("Greeting id is required", Constant::BAD_REQUEST);


				if ( !$request->filled('branch_office') )
					throw new \Exception("Branch office is required", Constant::BAD_REQUEST);
			*/


			$conection->beginTransaction();

			$third_insert = $this->third_implement
				->insertThird($conection,
					$request->organization_id,
					$request->logo,
					$request->is_customer,
					$request->is_vendor,
					$request->name,
					$request->name_2,
					$request->is_employee,
					$request->is_prospect,
					$request->is_sales_rep,
					$request->reference_no,
					$request->sales_rep_id,
					$request->credit_status,
					$request->credit_limit,
					$request->tax_id,
					$request->is_tax_exempt,
					$request->is_po_tax_exempt,
					$request->url,
					$request->description,
					$request->is_summary,
					$request->price_list_id,
					$request->delivery_rule,
					$request->delivery_via_rule,
					$request->flat_discount,
					$request->is_manufacturer,
					$request->po_price_list_id,
					$request->language_id,
					$request->greeting_id,
					$request->third_location,
					$request->branch_office
				);

			$conection->commit();

		} catch (\Exception $e) {

			
			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response($third_insert, Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function updateThird(Request $request)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

		   $conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

		   if ( !$request->filled('id') )
				throw new \Exception("Third is required", Constant::BAD_REQUEST);

			if ( !$request->filled('organization_id') )
				throw new \Exception("Organization is required", Constant::BAD_REQUEST);

			if ( !$request->filled('reference_no') )
				throw new \Exception("Reference number is required", Constant::BAD_REQUEST);

			if ( !$request->filled('name') )
				throw new \Exception("Third name is required", Constant::BAD_REQUEST);

			if ( !$request->filled('third_location') )
				throw new \Exception("Third Location is required", Constant::BAD_REQUEST);

			if ( $request->third_location['address_1'] == NULL )
				throw new \Exception("Indicate at least one address", Constant::BAD_REQUEST);

			/*
				if ( !$request->filled('logo') )
				throw new \Exception("Logo is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_customer') )
					throw new \Exception("Customer is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_vendor') )
					throw new \Exception("Vendor is required", Constant::BAD_REQUEST);

				if ( !$request->filled('name_2') )
					throw new \Exception("Third name 2 is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_employee') )
					throw new \Exception("Employee is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_prospect') )
					throw new \Exception("Prospect is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_sales_rep') )
					throw new \Exception("Sales rep is required", Constant::BAD_REQUEST);

				if ( !$request->filled('sales_rep_id') )
					throw new \Exception("Sales rep id is required", Constant::BAD_REQUEST);

				if ( !$request->filled('credit_status') )
					throw new \Exception("Credit status is required", Constant::BAD_REQUEST);

				if ( !$request->filled('credit_limit') )
					throw new \Exception("Credit limit is required", Constant::BAD_REQUEST);

				if ( !$request->filled('tax_id') )
					throw new \Exception("Tax id is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_tax_exempt') )
					throw new \Exception("Tax exempt is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_po_tax_exempt') )
					throw new \Exception("Pot ax exempt is required", Constant::BAD_REQUEST);

				if ( !$request->filled('url') )
					throw new \Exception("Url is required", Constant::BAD_REQUEST);

				if ( !$request->filled('description') )
					throw new \Exception("Description is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_summary') )
					throw new \Exception("Summary is required", Constant::BAD_REQUEST);

				if ( !$request->filled('price_list_id') )
					throw new \Exception("Price list id is required", Constant::BAD_REQUEST);

				if ( !$request->filled('delivery_rule') )
					throw new \Exception("Delivery rule is required", Constant::BAD_REQUEST);

				if ( !$request->filled('delivery_via_rule') )
					throw new \Exception("Delivery via rule is required", Constant::BAD_REQUEST);

				if ( !$request->filled('flat_discount') )
					throw new \Exception("Flat discount is required", Constant::BAD_REQUEST);

				if ( !$request->filled('is_manufacturer') )
					throw new \Exception("Manufacturer is required", Constant::BAD_REQUEST);

				if ( !$request->filled('po_price_list_id') )
					throw new \Exception("Po price list id is required", Constant::BAD_REQUEST);

				if ( !$request->filled('language_id') )
					throw new \Exception("Language id is required", Constant::BAD_REQUEST);

				if ( !$request->filled('greeting_id') )
					throw new \Exception("Greeting id is required", Constant::BAD_REQUEST);

				if ( !$request->filled('branch_office_data') )
					throw new \Exception("Branch Office data are required", Constant::BAD_REQUEST);
			*/

		  $conection->beginTransaction();

			$third_update = $this->third_implement
				->updateThird($conection,
					$request->id,
					$request->organization_id,
					$request->logo,
					$request->is_customer,
					$request->is_vendor,
					$request->name,
					$request->name_2,
					$request->is_employee,
					$request->is_prospect,
					$request->is_sales_rep,
					$request->reference_no,
					$request->sales_rep_id,
					$request->credit_status,
					$request->credit_limit,
					$request->tax_id,
					$request->is_tax_exempt,
					$request->is_po_tax_exempt,
					$request->url,
					$request->description,
					$request->is_summary,
					$request->price_list_id,
					$request->delivery_rule,
					$request->delivery_via_rule,
					$request->flat_discount,
					$request->is_manufacturer,
					$request->po_price_list_id,
					$request->language_id,
					$request->greeting_id,
					$request->third_location,
					$request->branch_office
				);

			 $conection->commit();

			if ( $request->filled('image') ){
				if($request->filled('storageNameClient')){
					// $path = $request->file('avatar')->store('avatars/'.$request->user()->id, 's3');
					$storageManager = new FilesUtils();
					$storageManager->setStorageSimple($request->header('authorization'));
					$fileContents = base64_decode($request->image);
					Storage::disk($request->storageNameClient)->put('thirds/'.'ba'. $request->id . 'na' . $request->organization_id . 'na.jpg', $fileContents,'public');
				}
			}



		} catch (\Exception $e) {

			
		  return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response($third_update, Constant::OK)->header('Content-Type', 'application/json');
	}

	public function archivedThird(Request $request)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

			if ( !$request->filled('third_id') )
				throw new \Exception("Third is required", Constant::BAD_REQUEST);

			if ( !$request->filled('archived') )
				throw new \Exception("Archived is required", Constant::BAD_REQUEST);

			$third_archived = $this->third_implement
				->archivedThird($conection, $request->third_id, $request->archived);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['third_archived' => $third_archived], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function deleteThird(Request $request, $third_id, $location_id)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

			$conection->beginTransaction();

			$third_delete = $this->third_implement
				->deleteThird($conection, $third_id, $location_id);

			$conection->commit();

		} catch (\Exception $e) {

			
			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['third_delete' => $third_delete], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function insertThirdContact(Request $request)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

		   if ( !$request->filled('id') )
				throw new \Exception('Third is required', Constant::BAD_REQUEST);

			if ( !$request->filled('contact') )
				throw new \Exception('Contact is required', Constant::BAD_REQUEST);

			if ( $request->contact['name'] == NULL )
				throw new \Exception("Contact name is required", Constant::BAD_REQUEST);

			$conection->beginTransaction();

			$third_contact_insert = $this->third_implement
				->insertThirdContact(
					$conection,
					$request->id,
					$request->contact
				);

			$conection->commit();

		} catch (\Exception $e) {

			
			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {
			
			$db_manager->terminateClientBDConecction();
		}

		return response($third_contact_insert, Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function deleteThirdContact(Request $request, $third_id, $contact_id)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

			$conection->beginTransaction();

			$third_contact_removed = $this->third_implement
				->deleteThirdContact($conection, $contact_id, $third_id);

			$conection->commit();

		} catch (\Exception $e) {

			
			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['third_contact_removed' => $third_contact_removed], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function storeBranchOffice(Request $request)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

			if ( !$request->filled('id') )
				throw new \Exception("Third is required", Constant::BAD_REQUEST);

			if ( !$request->filled('name') )
				throw new \Exception("Branch office name is required", Constant::BAD_REQUEST);

			if ( !$request->filled('branch_location') )
				throw new \Exception("Branch office location is required", Constant::BAD_REQUEST);

			if ( $request->branch_location['address_1'] == NULL )
				throw new \Exception("Indicate at least one address", Constant::BAD_REQUEST);

			$conection->beginTransaction();

			
			$branch = $this->third_implement->newBranchOffice(
				$conection,
				$request->id,
				$request->branch_location,
				$request->name,
				$request->is_ship_to,
				$request->is_bill_to,
				$request->is_pay_from,
				$request->is_remit_to,
				$request->phone,
				$request->phone_2,
				$request->fax,
				$request->isdn
			);

			$conection->commit();

		} catch (\Exception $e) {

			
			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response($branch, Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function updateBranchOffice(Request $request)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

			if ( !$request->filled('id') )
				throw new \Exception("Branch office is required", Constant::BAD_REQUEST);

			if ( !$request->filled('name') )
				throw new \Exception("Branch office name is required", Constant::BAD_REQUEST);

			if ( !$request->filled('branch_location') )
				throw new \Exception("Branch office location is required", Constant::BAD_REQUEST);

			if ( $request->branch_location['address_1'] == NULL )
				throw new \Exception("Indicate at least one address", Constant::BAD_REQUEST);

			$conection->beginTransaction();

			$branch = $this->third_implement->editBranchOffice(
				$conection,
				$request->id,
				$request->branch_location,
				$request->name,
				$request->is_ship_to,
				$request->is_bill_to,
				$request->is_pay_from,
				$request->is_remit_to,
				$request->phone,
				$request->phone_2,
				$request->fax,
				$request->isdn
			);

			$conection->commit();

		} catch (\Exception $e) {

			
			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response($branch, Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function archivedBranchOffice(Request $request)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

			if ( !$request->filled('branch_id') )
				throw new \Exception("Third is required", Constant::BAD_REQUEST);

			if ( !$request->filled('archived') )
				throw new \Exception("Archived is required", Constant::BAD_REQUEST);

			$branch_archived = $this->third_implement
				->archivedBranchOffice($conection, $request->branch_id, $request->archived);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['branch_archived' => $branch_archived], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function deleteBranchOffice(Request $request, $id)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

			$conection->beginTransaction();

			$branch_removed = $this->third_implement
				->deleteBranch($conection, $id);

			$conection->commit();

		} catch (\Exception $e) {

			
			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['branch_removed' => $branch_removed], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	/* Metodos de terceros para BananApp */

	public function customersBySellerId(Request $request, $seller_id)
	{
		$db_manager = new DBManager();

		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$customers = $this->third_implement->customersBySellerId($conection, $seller_id);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response($customers, Constant::OK)->header('Content-Type', 'application/json');
	}
	
	public function test()
	{
		try {

			$conection = null;
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$customers = $this->third_implement->test($conection);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response($customers, Constant::OK)->header('Content-Type', 'application/json');
	}

}
