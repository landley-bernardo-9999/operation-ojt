<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'payment_transaction_id',
        'desc',
        'amt',
        'payment_status',
        'or_number',
        'ar_number',
        'form_of_payment',
        'check_no',
        'date_deposited',
        'bank_name',
        'amt_paid',
        'note',
        'remittance_amt',
        'mgmt_fee',
        'condo_dues',
        'remittance_note',
        'others',
    ];

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
