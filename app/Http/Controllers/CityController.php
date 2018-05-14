<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $search = $request->search;
        $criterion = $request->criterion;

        if ($search == '') {
            
        	$cities = City::orderBy('city', 'ASC')
                ->paginate(5);

            foreach ($cities as $key => $city) {
                
                $city->state->country;

            }

        } elseif ($criterion == 'state') {

            $cities = City::whereHas('state', function ($query) use ($criterion, $search) {

                    $query->where($criterion, 'like', '%'.$search.'%');

                })
                ->orderBy('city', 'ASC')
                ->paginate(5);

            foreach ($cities as $key => $city) {
                
                $city->state->country;

            }

        } elseif ($criterion == 'country') {

            $cities = City::whereHas('state', function ($query_0) use ($criterion, $search) {

                    $query_0->whereHas('country', function($query_1) use ($criterion, $search) {

                        $query_1->where($criterion, 'like', '%'.$search.'%');

                    });

                })
                ->orderBy('city', 'ASC')
                ->paginate(5);

            foreach ($cities as $key => $city) {
                
                $city->state->country;

            }

        } else {

            $cities = City::orderBy('city', 'ASC')
                ->where($criterion, 'like', '%'.$search.'%')
                ->paginate(5);

            foreach ($cities as $key => $city) {
                
                $city->state->country;

            }

        }

    	return [
            'pagination' => [
                'total' => $cities->total(),
                'current_page' => $cities->currentPage(),
                'per_page' => $cities->perPage(),
                'last_page' => $cities->lastPage(),
                'from' => $cities->firstItem(),
                'to' => $cities->lastItem()
            ],
            'cities' => $cities
        ];
    }

    public function listCountries(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $countries = DB::table('countries')
            ->select('id', 'country')
            ->where('archived', 0)
            ->orWhere('id', $request->country_id)
            ->orderBy('country')
            ->get();

        return $countries;
    }

    public function listStates(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $states = DB::table('states')
            ->select('id', 'state')
            ->where([
                ['country_id', '=', $request->country_id],
                ['archived', '=', 0]
            ])
            ->orWhere('id', $request->state_id)
            ->orderBy('state')
            ->get();

        return $states;
    }

    public function store(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $city = new City();
        $city->state_id = $request->state_id;
        $city->city = $request->city;
        $city->capital = $request->capital;
        $city->archived = '0';
        $city->save();
    }

    public function update(Request $request)
    {
        //if ( ! $request->ajax() ) return redirect('/');

        $city = City::findOrFail($request->id);
        $city->state_id = $request->state_id;
        $city->city = $request->city;
        $city->capital = $request->capital;
        $city->archived = '0';
        $city->save();
    }

    public function archived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $city = City::findOrFail($request->id);
        $city->archived = '1';
        $city->save();
    }

    public function desarchived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $city = City::findOrFail($request->id);
        $city->archived = '0';
        $city->save();
    }
}
