<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $search = $request->search;
        $criterion = $request->criterion;

        if ($search == '')
            $units = Unit::orderBy('tag')->paginate(5);
        else
            $units = Unit::where($criterion, 'like', '%'.$search.'%')->orderBy('tag')->paginate(5);

        return [
            'pagination' => [
                'total' => $units->total(),
                'current_page' => $units->currentPage(),
                'per_page' => $units->perPage(),
                'last_page' => $units->lastPage(),
                'from' => $units->firstItem(),
                'to' => $units->lastItem()
            ],
            'units' => $units
        ];
    }

    public function store(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $unit = new Unit();
        $unit->tag = $request->tag;
        $unit->quantity = $request->quantity;
        $unit->archived = '0';
        $unit->save();
    }

    public function update(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $unit = Unit::findOrFail($request->id);
        $unit->tag = $request->tag;
        $unit->quantity = $request->quantity;
        $unit->archived = '0';
        $unit->save();
    }

    public function archived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $unit = Unit::findOrFail($request->id);
        $unit->archived = '1';
        $unit->save();
    }

    public function desarchived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $unit = Unit::findOrFail($request->id);
        $unit->archived = '0';
        $unit->save();
    }
}
