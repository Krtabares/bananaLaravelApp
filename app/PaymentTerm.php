<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTerm extends Model
{
    //protected $table = 'payment_terms';
    protected $fillable = ['name', 'notes', 'archived'];

    public function termTypes()
    {
    	return $this->hasmany('App\TermType');
    }
}
