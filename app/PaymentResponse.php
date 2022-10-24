<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentResponse extends Model
{
    protected $table = 'payment_responses';
    protected $fillable = [
        'charge_id',
        'balance_transaction_id',
        'amount',
        'converted_amount',
        'currency',
        'created',
        'status',
        'response',
        'method',
        'search_id'
    ];
}
