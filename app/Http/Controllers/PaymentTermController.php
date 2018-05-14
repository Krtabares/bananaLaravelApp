<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentTerm;

class PaymentTermController extends Controller
{
    public function index(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $search = $request->search;
        $criterion = $request->criterion;

        if ($search == '')
            $payment_terms = PaymentTerm::orderBy('name')->paginate(5);
        else
            $payment_terms = PaymentTerm::where($criterion, 'like', '%'.$search.'%')->orderBy('name')->paginate(5);

        return [
            'pagination' => [
                'total' => $payment_terms->total(),
                'current_page' => $payment_terms->currentPage(),
                'per_page' => $payment_terms->perPage(),
                'last_page' => $payment_terms->lastPage(),
                'from' => $payment_terms->firstItem(),
                'to' => $payment_terms->lastItem()
            ],
            'payment_terms' => $payment_terms
        ];
    }

    public function store(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $payment_term = new PaymentTerm();
        $payment_term->name = $request->name;
        $payment_term->notes = $request->notes;
        $payment_term->archived = '0';
        $payment_term->save();
    }

    public function update(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $payment_term = PaymentTerm::findOrFail($request->id);
        $payment_term->name = $request->name;
        $payment_term->notes = $request->notes;
        $payment_term->archived = '0';
        $payment_term->save();
    }

    public function archived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $payment_term = PaymentTerm::findOrFail($request->id);
        $payment_term->archived = '1';
        $payment_term->save();
    }

    public function desarchived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $payment_term = PaymentTerm::findOrFail($request->id);
        $payment_term->archived = '0';
        $payment_term->save();
    }
}
