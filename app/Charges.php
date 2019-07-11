<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charges extends Model
{
    protected $primaryKey = 'charge_id';

    protected $fillable = [
              'charge_trans_id',
              'item',
              'qty',
              'amt',
              'total_amt'
    ];
    
    public function transactions(){
        return $this->belongsTo(Transaction::class);
    }
}
