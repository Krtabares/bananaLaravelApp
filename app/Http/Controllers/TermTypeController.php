<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TermType;

class TermTypeController extends Controller
{
    public function index(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $term_types = TermType::where('payment_terms_id', '=', $request->payment_term_id)
            ->orderBy('id')
            ->get();

        return $term_types;
    }

    public function store(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $term_type = new TermType();
        $term_type->tag = $request->tag;
        $term_type->quantity = $request->quantity;
        $term_type->archived = '0';
        $term_type->save();
    }

    public function update(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $term_type = TermType::findOrFail($request->id);
        $term_type->tag = $request->tag;
        $term_type->quantity = $request->quantity;
        $term_type->archived = '0';
        $term_type->save();
    }

    public function archived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $term_type = TermType::findOrFail($request->id);
        $term_type->archived = '1';
        $term_type->save();
    }

    public function desarchived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $term_type = TermType::findOrFail($request->id);
        $term_type->archived = '0';
        $term_type->save();
    }
}
