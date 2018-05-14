<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

    	$search = $request->search;
        $criterion = $request->criterion;

        if ($search == '')
            $countries = Country::orderBy('country')->paginate(5);
        else
            $countries = Country::where($criterion, 'like', '%'.$search.'%')->orderBy('country')->paginate(5);

    	return [
            'pagination' => [
                'total' => $countries->total(),
                'current_page' => $countries->currentPage(),
                'per_page' => $countries->perPage(),
                'last_page' => $countries->lastPage(),
                'from' => $countries->firstItem(),
                'to' => $countries->lastItem()
            ],
            'countries' => $countries
        ];
    }

    public function store(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $country = new Country();
        $country->iso = $request->iso;
        $country->country = $request->country;
        $country->archived = '0';
        $country->save();
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

    public function archived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $country = Country::findOrFail($request->id);
        $country->archived = '1';
        $country->save();
    }

    public function destroy(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $country = Country::findOrFail($request->id);
        $country->delete();
    }
}
