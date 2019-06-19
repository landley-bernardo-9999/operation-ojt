<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $primaryKey = 'contract_id';

    protected $fillable = [
        'enrollment_date',
        'contract_owner_id',
        'contract_room_id',
    ];

    public function owners(){
        return $this->belongsTo(Owner::class);
    }


}
