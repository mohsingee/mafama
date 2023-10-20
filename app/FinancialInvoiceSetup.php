<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class FinancialInvoiceSetup extends Model
{
    protected $fillable = [
        'uid','is_tax','tax_rate','shipping_cost','shipping_rate', 'shipping_amount', 'shipping_method',
    ];


  

}
