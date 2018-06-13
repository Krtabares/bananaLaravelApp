<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\Third;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\ThirdBnImplement;

class ThirdController extends Controller
{
    private $third_implement;

    function __construct(ThirdBnImplement $third_implement)
    {
        $this->third_implement = $third_implement;
    }

    public function indexThird(Request $request)
    {
        $db_manager = new DBManager();

        try {
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            $thirds = $this->third_implement->selectThirds($conection);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['thirds' => $thirds]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function storeThird(Request $request)
    {
    	$db_manager = new DBManager();

        try {

        	if ( !$request->filled('authorization') )
                throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

           $conection = $db_manager->getClientBDConecction(
                $request->authorization,
                $request->user_id,
                $request->token,
                $request->app
            );

            if ( !$request->filled('org_id') )
                throw new \Exception("Organization is required", Constant::BAD_REQUEST);

            if ( !$request->filled('logo') )
                throw new \Exception("Logo is required", Constant::BAD_REQUEST);

            if ( !$request->filled('customer') )
                throw new \Exception("Customer is required", Constant::BAD_REQUEST);

            if ( !$request->filled('vendor') )
                throw new \Exception("Vendor is required", Constant::BAD_REQUEST);

            if ( !$request->filled('third_name') )
                throw new \Exception("Third name is required", Constant::BAD_REQUEST);

            // if ( !$request->filled('third_name_2') )
            //     throw new \Exception("Third name 2 is required", Constant::BAD_REQUEST);

            if ( !$request->filled('employee') )
                throw new \Exception("Employee is required", Constant::BAD_REQUEST);

            if ( !$request->filled('prospect') )
                throw new \Exception("Prospect is required", Constant::BAD_REQUEST);

            if ( !$request->filled('sales_rep') )
                throw new \Exception("Sales rep is required", Constant::BAD_REQUEST);

            if ( !$request->filled('reference_no') )
                throw new \Exception("Reference no is required", Constant::BAD_REQUEST);

            if ( !$request->filled('sales_rep_id') )
                throw new \Exception("Sales rep id is required", Constant::BAD_REQUEST);

            if ( !$request->filled('credit_status') )
                throw new \Exception("Credit status is required", Constant::BAD_REQUEST);

            if ( !$request->filled('credit_limit') )
                throw new \Exception("Credit limit is required", Constant::BAD_REQUEST);

            if ( !$request->filled('total_open_balance') )
                throw new \Exception("Total open balance is required", Constant::BAD_REQUEST);

            if ( !$request->filled('tax_id') )
                throw new \Exception("Tax id is required", Constant::BAD_REQUEST);

            if ( !$request->filled('tax_exempt') )
                throw new \Exception("Tax exempt is required", Constant::BAD_REQUEST);

            if ( !$request->filled('pot_ax_exempt') )
                throw new \Exception("Pot ax exempt is required", Constant::BAD_REQUEST);

            if ( !$request->filled('url') )
                throw new \Exception("Url is required", Constant::BAD_REQUEST);
            
            if ( !$request->filled('description') )
                throw new \Exception("Description is required", Constant::BAD_REQUEST);
            
            if ( !$request->filled('summary') )
                throw new \Exception("Summary is required", Constant::BAD_REQUEST);
            
            if ( !$request->filled('price_list_id') )
                throw new \Exception("Price list id is required", Constant::BAD_REQUEST);
            
            if ( !$request->filled('delivery_rule') )
                throw new \Exception("Delivery rule is required", Constant::BAD_REQUEST);

            if ( !$request->filled('delivery_via_rule') )
                throw new \Exception("Delivery via rule is required", Constant::BAD_REQUEST);

            if ( !$request->filled('flat_discount') )
                throw new \Exception("Flat discount is required", Constant::BAD_REQUEST);

            if ( !$request->filled('manufacturer') )
                throw new \Exception("Manufacturer is required", Constant::BAD_REQUEST);
            
            if ( !$request->filled('po_price_list_id') )
                throw new \Exception("Po price list id is required", Constant::BAD_REQUEST);

            if ( !$request->filled('language_id') )
                throw new \Exception("Language id is required", Constant::BAD_REQUEST);

            if ( !$request->filled('greeting_id') )
                throw new \Exception("Greeting id is required", Constant::BAD_REQUEST);

            $third_insert = $this->third_implement
                ->insertThird($conection, $request->org_id, $request->logo, $request->customer, 
		    		$request->vendor, $request->third_name, $request->third_name_2, $request->employee, $request->prospect, $request->sales_rep,
		    		$request->reference_no, $request->sales_rep_id, $request->credit_status, $request->credit_limit, $request->total_open_balance,
		    		$request->tax_id, $request->tax_exempt, $request->pot_ax_exempt, $request->url, $request->description, $request->summary,
		    		$request->price_list_id, $request->delivery_rule, $request->delivery_via_rule, $request->flat_discount,
		    		$request->manufacturer, $request->po_price_list_id, $request->language_id, $request->greeting_id);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['third_insert' => $third_insert], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function archivedThird(Request $request)
    {
    	$db_manager = new DBManager();

        try {

        	if ( !$request->filled('authorization') )
                throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

           $conection = $db_manager->getClientBDConecction(
                $request->authorization,
                $request->user_id,
                $request->token,
                $request->app
            );

            if ( !$request->filled('third_id') )
                throw new \Exception("Third is required", Constant::BAD_REQUEST);

            if ( !$request->filled('archived') )
                throw new \Exception("Archived is required", Constant::BAD_REQUEST);

            $third_archived = $this->third_implement
                ->archivedThird($conection, $request->third_id, $request->archived);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['third_archived' => $third_archived], Constant::OK)->header('Content-Type', 'application/json');
    }
}
