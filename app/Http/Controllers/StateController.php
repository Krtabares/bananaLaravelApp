<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    public function index(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $search = $request->search;
        $criterion = $request->criterion;

        if ($search == '') {

            $states = State::orderBy('state', 'ASC')
                ->paginate(5);

            foreach ($states as $key => $state) {
                
                $state->country;

            }

        } elseif ($criterion == 'country') {

            $states = State::whereHas('country', function ($query) use ($criterion, $search) {

                    $query->where($criterion, 'like', '%'.$search.'%');

                })
                ->orderBy('state', 'ASC')                
                ->paginate(5);

            foreach ($states as $key => $state) {
                
                $state->country;

            }

        } else {

            $states = State::where($criterion, 'like', '%'.$search.'%')
                ->orderBy('state', 'ASC')                
                ->paginate(5);

            foreach ($states as $key => $state) {
                
                $state->country;

            }

        }

        return [
            'pagination' => [
                'total' => $states->total(),
                'current_page' => $states->currentPage(),
                'per_page' => $states->perPage(),
                'last_page' => $states->lastPage(),
                'from' => $states->firstItem(),
                'to' => $states->lastItem()
            ],
            'states' => $states
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

    public function store(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $state = new State();
        $state->country_id = $request->country_id;
        $state->iso = $request->iso;
        $state->state = $request->state;
        $state->archived = '0';
        $state->save();
    }

    public function update(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $state = State::findOrFail($request->id);
        $state->country_id = $request->country_id;
        $state->iso = $request->iso;
        $state->state = $request->state;
        $state->archived = '0';
        $state->save();
    }

    public function archived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $state = State::findOrFail($request->id);
        $state->archived = '1';
        $state->save();
    }

    public function desarchived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $state = State::findOrFail($request->id);
        $state->archived = '0';
        $state->save();
    }
}
