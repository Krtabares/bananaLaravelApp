<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Illuminate\Validation\Rule;



class CountryController extends Controller
{
 /**
 * @SWG\Get(
 *      path="/api/countries",
 *      operationId="index",
 *      tags={"Countries"},
 *      summary="Get list of countries",
 *      description="Returns list of countries",
 *      @SWG\Response(
 *          response=200,
 *          description="successful operation"
 *       ),
 *      @SWG\Response(
 *           response=400,
 *           description="Bad request"
 *       ),
 *       security={
 *           {"api_key_security_example": {}}
 *       }
 *     )
 *
 * Returns list of projects
 */
    public function index(Request $request)
    {
        //if ( ! $request->ajax() ) return redirect('/');

    	$search = $request->search;
        $criterion = $request->criterion;

        if ($search == '')
            $countries = Country::orderBy('country')->get();
        else
            $countries = Country::where($criterion, 'like', '%'.$search.'%')->orderBy('country')->paginate(5);

    	return $countries;
    }
 /**
 * @SWG\Post(
 *      path="/api/countries/new",
 *      operationId="store",
 *      tags={"Countries"},
 *      summary="create countries",
 *      description="Create countries",
 *      @SWG\Response(
 *          response=200,
 *          description="successful operation"
 *       ),
 *      @SWG\Response(
 *           response=400,
 *           description="Bad request"
 *       ),
*      @SWG\Response(
 *           response=501,
 *           description="Error in Data Base"
 *       ),
 *      @SWG\Parameter(
 *          name="iso",
 *          description="iso description",
 *          required=true,
 *          type="string",
 *          in="body",
 *          @SWG\Schema(ref="Providers/Country/definitions/iso"),  
 *      ),
 *     @SWG\Parameter(
 *          name="country",
 *          description="country description",
 *          required=true,
 *          type="string",
 *          in="body",
 *          @SWG\Schema(ref="definitions/country"),
 *      ),
 *   
 *       security={
 *           {"api_key_security_example": {}}
 *       }
 *     )
 *
 * save  country
 */
    public function store(Request $request)
    {
        // if ( ! $request->ajax() ) return redirect('/');

        $country = new Country();
        $country->iso = $request->iso;
        $country->country = $request->country;
        $country->archived = '0';
        try {
            $country->save();
        } catch (\Illuminate\Database\QueryException $ex) {
            
            switch ($ex->errorInfo[1]) {
                case 1406:
                    return response('Error de tamaño en campos', 501)->header('Content-Type', 'application/json'); 
                break;
                case 1062:
                    return response('Valor existente', 501)->header('Content-Type', 'application/json'); 
                break;               
                default:
                    return response('Error en Base de Datos', 501)->header('Content-Type', 'application/json'); 
                break;
            }
                
        } catch (Exception $e) {


            return response($e->getMessage(), 500);
        }
        
       return response('Creado con exito', 200)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $country = Country::findOrFail($request->id);
        $country->iso = $request->iso;
        $country->country = $request->country;
        $country->archived = '0';
        $country->save();
    }

    public function desarchived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $country = Country::findOrFail($request->id);
        $country->archived = '0';
        $country->save();
    }

 /**
 * @SWG\Put(
 *      path="/api/countries/archived",
 *      operationId="archived",
 *      tags={"Countries"},
 *      summary="archived countries",
 *      description="archived countries",
 *      @SWG\Response(
 *          response=200,
 *          description="successful operation"
 *       ),
 *      @SWG\Response(
 *           response=400,
 *           description="Bad request"
 *       ),
 *      @SWG\Response(
 *           response=501,
 *           description="Error in Data Base"
 *       ),
 *       @SWG\Response(
 *           response=519,
 *           description="not found"
 *       ),
 *      @SWG\Parameter(
 *          name="id",
 *          description="id country",
 *          required=true,
 *          type="integer",
 *          in="body",
 *          @SWG\Schema(ref="Providers/Country/definitions/id"),  
 *      ),
 *   
 *       security={
 *           {"api_key_security_example": {}}
 *       }
 *     )
 *
 * save  country
 */
    public function archived(Request $request)
    {
        try {
            
            $country = Country::find($request->id);
            if($country != null){
                
                $country->archived = '1';
                $country->save();

            }else{
                return response('No encontrado', 519)->header('Content-Type', 'application/json'); 
            }

        } catch (\Illuminate\Database\QueryException $ex) {

           return response('Error en Base de Datos', 501)->header('Content-Type', 'application/json');   
        }

        return response('archivado con exito', 200)->header('Content-Type', 'application/json');

    }

    public function destroy(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $country = Country::findOrFail($request->id);
        $country->delete();
    }
}
