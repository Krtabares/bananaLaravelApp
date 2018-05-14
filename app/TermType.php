<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermType extends Model
{
    //protected $table = 'term_types';
    protected $fillable = [
    	'payment_terms_id',
    	'type',
    	'day',
    	'typeid',
    	'typeem',
    	'typenm',
        'fixed_amount',
        'percentage',
        'daydxpp',
        'percentdxpp'
    ];

    public function paymentTerm()
    {
        return $this->belongsTo('App\PaymentTerm');
    }
}
