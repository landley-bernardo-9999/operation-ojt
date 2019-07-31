<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'trans_id';

    public $timestamps  = false;

    protected $fillable = [
        'trans_date',
        'trans_room_id',
        'trans_resident_id',
        'trans_owner_id',
        'trans_status',
        'move_in_date',
        'move_out_date',
        'actual_move_out_date',
        'move_out_reason',
        'term',
        'initial_water_reading',
        'initial_electric_reading',
        'final_water_reading',
        'final_electric_reading',

    ];


}
