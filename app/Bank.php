<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $primaryKey = 'bank_id';

    protected $fillable = [
        'bank_owner_id',
        'bank_name',
        'bank_account_name',
        'bank_account_number'
    ];
}
