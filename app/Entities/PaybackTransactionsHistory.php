<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PaybackTransactionsHistory extends Model
{
    protected $table = 'payback_transactions_history';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'account_id',
        'transaction_id',
        'transaction_information',
        'transaction_amount',
        'payback_percentage',
        'payback_generated',
        'payback_total',
        'date'
    ];
    public $timestamps = false;
}
